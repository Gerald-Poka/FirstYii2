<?php

namespace app\components;

use Yii;
use yii\filters\AccessControl as BaseAccessControl;
use app\models\User;

class AccessControl extends BaseAccessControl
{
    /**
     * Check if the user is an admin
     */
    public function isAdmin()
    {
        return !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin();
    }
    
    /**
     * Check if the user is logged in
     */
    public function isUser()
    {
        return !Yii::$app->user->isGuest;
    }
    
    /**
     * Check if the user is a guest
     */
    public function isGuest()
    {
        return Yii::$app->user->isGuest;
    }
}