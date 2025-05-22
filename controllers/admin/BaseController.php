<?php

namespace app\controllers\admin;

use Yii;
use app\controllers\BaseController as AppBaseController;
use yii\filters\AccessControl;

/**
 * Base controller for all admin controllers
 */
class BaseController extends AppBaseController
{
    /**
     * Set the layout for all admin controllers
     */
    public $layout = 'main_wide';
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            // Only allow admin users (assuming role 20 is admin)
                            return !Yii::$app->user->isGuest && 
                                   isset(Yii::$app->user->identity->role) && 
                                   Yii::$app->user->identity->role == 20;
                        }
                    ],
                ],
            ],
        ];
    }
}