<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $firstname
 * @property string $lastname
 * @property string|null $avatar
 * @property int $role
 * @property string $auth_key
 * @property string|null $access_token
 * @property string $created_at
 * @property string $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ROLE_USER = 10;
    const ROLE_ADMIN = 20;
    
    // Public property for handling password in forms
    public $password;
    public $password_repeat;
    
    /**
     * @var yii\web\UploadedFile
     */
    public $avatarFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username'], 'unique', 'message' => 'This username has already been taken.'],
            [['email'], 'email'],
            [['email'], 'unique', 'message' => 'This email address has already been taken.'],
            [['password'], 'required', 'on' => 'create'],
            [['password'], 'string', 'min' => 6],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match.'],
            [['firstname', 'lastname'], 'string', 'max' => 255],
            [['role'], 'integer'],
            ['avatarFile', 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, png, gif', 'maxSize' => 2 * 1024 * 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Email',
            'email' => 'Email',
            'password' => 'Password',
            'password_hash' => 'Password Hash',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'avatar' => 'Avatar',
            'role' => 'Role',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'avatarFile' => 'Profile Picture',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username (email)
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    /**
     * Gets the full name of the user
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    
    /**
     * Gets the avatar URL
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        if (!$this->avatar) {
            return '/images/avatars/default.jpg';
        }
        return '/images/avatars/' . $this->avatar;
    }
    
    /**
     * Checks if the user has admin privileges
     * @return boolean Whether the user is an admin
     */
    public function isAdmin()
    {
        // Use the constant instead of string comparison
        return $this->role === self::ROLE_ADMIN;
    }
    
    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Handle timestamps
            if ($this->isNewRecord) {
                $this->created_at = date('Y-m-d H:i:s');
                
                // Set default values for new records
                if (empty($this->role)) {
                    $this->role = self::ROLE_USER;
                }
            }
            
            $this->updated_at = date('Y-m-d H:i:s');
            
            // Only hash the password if it's set (and not already hashed)
            if (!empty($this->password) && empty($this->password_hash)) {
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            }
            
            // Generate auth key if empty
            if (empty($this->auth_key)) {
                $this->auth_key = Yii::$app->security->generateRandomString();
            }
            
            return true;
        }
        return false;
    }
    
    /**
     * Scenarios for different forms
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['username', 'email', 'password', 'password_repeat', 'firstname', 'lastname', 'avatarFile', 'role'];
        return $scenarios;
    }
}
