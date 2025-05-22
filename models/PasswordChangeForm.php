<?php


namespace app\models;

use Yii;
use yii\base\Model;

/**
 * PasswordChangeForm is the model for changing user password.
 */
class PasswordChangeForm extends Model
{
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currentPassword', 'newPassword', 'confirmPassword'], 'required'],
            ['currentPassword', 'validateCurrentPassword'],
            ['newPassword', 'string', 'min' => 6],
            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => 'Passwords do not match.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'currentPassword' => 'Current Password',
            'newPassword' => 'New Password',
            'confirmPassword' => 'Confirm New Password',
        ];
    }

    /**
     * Validates the current password.
     *
     * @param string $attribute the attribute being validated
     */
    public function validateCurrentPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = Yii::$app->user->identity;
            
            if (!$user || !$user->validatePassword($this->$attribute)) {
                $this->addError($attribute, 'Current password is incorrect.');
            }
        }
    }

    /**
     * Changes the user's password.
     *
     * @return bool whether the password was changed successfully
     */
    public function changePassword()
    {
        if ($this->validate()) {
            $user = Yii::$app->user->identity;
            $user->setPassword($this->newPassword);
            return $user->save(false); // false means no validation
        }
        
        return false;
    }
}