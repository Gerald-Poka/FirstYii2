<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class NormalController extends Controller
{
    // ...existing code...

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // Redirect guests to login
            if (Yii::$app->user->isGuest) {
                $this->redirect(['/site/login']);
                return false;
            }
            
            // Redirect admins to admin dashboard
            if ($action->id === 'dashboard' && Yii::$app->user->identity->isAdmin()) {
                $this->redirect(['/admin/dashboard']);
                return false;
            }
            
            return true;
        }
        return false;
    }

    public function actionDashboard()
    {
        // Specify to use the main_wide layout
        $this->layout = 'main_wide';
        
        return $this->render('dashboard');
    }

    // ...existing code...
}