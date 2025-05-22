<?php

namespace app\controllers\admin;

use Yii;
use app\controllers\BaseController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Dashboard controller for the admin section
 */
class DashboardController extends BaseController
{
    /**
     * Set the layout for all actions in this controller
     */
    public $layout = 'main_wide';
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        // Add access control
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'], // @ means authenticated users
                    'matchCallback' => function ($rule, $action) {
                        // Only allow admin users (role 20)
                        return !Yii::$app->user->isGuest && 
                               isset(Yii::$app->user->identity->role) && 
                               Yii::$app->user->identity->role == 20;
                    }
                ],
            ],
        ];
        
        // Add verb filter
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'delete' => ['post'],
            ],
        ];
        
        return $behaviors;
    }

    /**
     * Dashboard index action - displays the admin dashboard
     *
     * @return string
     */
    public function actionIndex()
    {
        // Add debugging to see if this controller is being called
        Yii::debug('Admin DashboardController::actionIndex is being called');
        
        // Render the existing dashboard view
        return $this->render('/admin/dashboard');
    }
}
