<?php


namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\components\AccessControl;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['view', 'edit', 'settings'],
                'rules' => [
                    [
                        'actions' => ['view', 'edit', 'settings'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return $this->isUser();
                        }
                    ],
                ],
            ],
        ];
    }
    
    protected function isUser()
    {
        return !Yii::$app->user->isGuest;
    }
    
    // Controller actions...
}