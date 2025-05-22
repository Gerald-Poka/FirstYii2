<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\components\AccessControl;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['dashboard', 'user-management', 'settings'],
                'rules' => [
                    [
                        'actions' => ['dashboard', 'user-management', 'settings'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return $this->isAdmin();
                        }
                    ],
                ],
            ],
        ];
    }
    
    protected function isAdmin()
    {
        return !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin();
    }
    
    public function actionDashboard()
    {
        // Ensure only admins can access
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin()) {
            return $this->redirect(['/site/login']);
        }
        
        // Specify to use the main_wide layout
        $this->layout = 'main_wide';
        
        return $this->render('dashboard');
    }
    
    public function actionUserManagement()
    {
        return $this->render('user-management');
    }
    
    public function actionSettings()
    {
        return $this->render('settings');
    }
}