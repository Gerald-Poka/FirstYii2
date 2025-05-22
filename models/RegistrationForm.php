<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * RegistrationForm is the model behind the registration form.
 */
class RegistrationForm extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $password_repeat;
    public $avatarFile;
    public $terms;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'email', 'password', 'password_repeat', 'terms'], 'required'],
            [['firstname', 'lastname'], 'string', 'min' => 2, 'max' => 50],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class, 'targetAttribute' => ['email' => 'email']],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match.'],
            ['terms', 'boolean'],
            ['terms', 'compare', 'compareValue' => 1, 'message' => 'You must agree to the terms and conditions.'],
            [['avatarFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 2],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'password_repeat' => 'Confirm Password',
            'avatarFile' => 'Profile Picture',
            'terms' => 'I agree to the terms and conditions',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the registration was successful
     */
    public function register()
    {
        // Validate the form model first
        if (!$this->validate()) {
            Yii::error('Registration validation failed: ' . print_r($this->errors, true));
            return false;
        }
        
        // Start database transaction
        $transaction = Yii::$app->db->beginTransaction();
        
        try {
            $user = new User();
            
            // Set user properties
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->email = $this->email;
            $user->username = $this->email; // Username is same as email
            
            // Generate password hash manually instead of relying on beforeSave
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            
            // Set default role
            $user->role = User::ROLE_USER; // Default role is regular user
            
            // Generate auth key if not already done in beforeSave
            $user->auth_key = Yii::$app->security->generateRandomString();
            
            // Upload avatar if provided
            $avatarFilename = $this->uploadAvatar();
            if ($avatarFilename) {
                $user->avatar = $avatarFilename;
            }
            
            // Debug the user model before saving
            Yii::debug('User model before save: ' . print_r($user->attributes, true));
            
            // Save the user and handle any validation errors
            if (!$user->save()) {
                Yii::error('User save failed: ' . print_r($user->errors, true));
                $transaction->rollBack();
                
                // Transfer errors from user model to form model
                foreach ($user->errors as $attribute => $errors) {
                    foreach ($errors as $error) {
                        $this->addError($attribute, $error);
                    }
                }
                
                return false;
            }
            
            // Everything went well, commit the transaction
            $transaction->commit();
            Yii::info('User registered successfully: ' . $user->id);
            return true;
            
        } catch (\Exception $e) {
            // Rollback the transaction on any exception
            $transaction->rollBack();
            Yii::error('Exception during registration: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            $this->addError('email', 'Registration failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Upload avatar file if provided
     * 
     * @return string|null The filename or null if no file was uploaded
     */
    private function uploadAvatar()
    {
        // Only process if avatarFile is an UploadedFile instance
        if ($this->avatarFile instanceof UploadedFile) {
            // Debug the uploaded file
            Yii::debug('Processing avatar upload: ' . print_r($this->avatarFile, true));
            
            $filename = 'user_' . time() . '.' . $this->avatarFile->extension;
            $uploadsDir = Yii::getAlias('@webroot/images/avatars/');
            
            // Create directory if it doesn't exist
            if (!is_dir($uploadsDir)) {
                mkdir($uploadsDir, 0777, true);
            }
            
            $filePath = $uploadsDir . $filename;
            
            // Save the file and check for errors
            if ($this->avatarFile->saveAs($filePath)) {
                Yii::debug('Avatar saved successfully: ' . $filePath);
                return $filename;
            } else {
                Yii::error('Failed to save avatar: ' . $filePath);
                // Add form error
                $this->addError('avatarFile', 'Failed to upload profile picture.');
            }
        }
        
        return null;
    }
}