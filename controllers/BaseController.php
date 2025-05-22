<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // Set layout based on authentication status
            if (!Yii::$app->user->isGuest) {
                $this->layout = 'main_wide';
            }
            return true;
        }
        return false;
    }
}