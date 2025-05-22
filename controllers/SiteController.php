<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegistrationForm;
use yii\web\UploadedFile;
use app\models\PasswordChangeForm;

class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // For logged-in users, use main_wide and show dashboard index
        if (!Yii::$app->user->isGuest) {
            $this->layout = 'main_wide';
            return $this->render('//site/index'); // Assuming you have a dashboard view
        }
        
        // For guests, use main layout and show the website index
        $this->layout = 'main';
        return $this->render('//website/index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            // If already logged in, redirect to appropriate dashboard
            return $this->redirectBasedOnRole();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // After successful login, redirect based on role
            return $this->redirectBasedOnRole();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Helper method to redirect users based on their role
     */
    protected function redirectBasedOnRole()
    {
        // Get current user
        $user = Yii::$app->user->identity;
        
        // Check if user is admin
        if ($user->isAdmin()) {
            // Redirect to admin dashboard
            return $this->redirect(['/admin/dashboard']);
        } else {
            // Redirect to normal user dashboard
            return $this->redirect(['/normal/dashboard']);
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
            return $this->refresh();
        }
        
        return $this->render('//website/bodies/contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $this->layout = 'main'; // Explicitly use main layout
        return $this->render('//website/bodies/about');
    }

    /**
     * Registration action.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        // Redirect if already logged in
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // Use main layout with no footer for register
        $this->layout = 'main';
        // Set a view parameter to indicate footer should be hidden
        $this->view->params['hideFooter'] = true;

        $model = new RegistrationForm();
        
        if (Yii::$app->request->isPost) {
            // Load post data
            $model->load(Yii::$app->request->post());
            
            // Handle file upload - must be done after loading post data
            $model->avatarFile = UploadedFile::getInstance($model, 'avatarFile');
            
            // Debug logging
            Yii::debug('Registration form submitted');
            Yii::debug('Form data: ' . print_r($model->attributes, true));
            
            if ($model->register()) {
                Yii::$app->session->setFlash('success', 'Thank you for registering. You can now log in.');
                return $this->redirect(['login']);
            } else {
                // Format the errors for display
                $errorMessages = [];
                foreach ($model->errors as $attribute => $errors) {
                    foreach ($errors as $error) {
                        $errorMessages[] = $attribute . ': ' . $error;
                    }
                }
                
                // Log detailed errors
                Yii::error('Registration failed with errors: ' . print_r($model->errors, true));
                
                // Display specific error messages to the user
                if (!empty($errorMessages)) {
                    Yii::$app->session->setFlash('error', 'Registration failed: ' . implode(', ', $errorMessages));
                } else {
                    Yii::$app->session->setFlash('error', 'Registration failed due to an unknown error. Please try again.');
                }
            }
        }
        
        return $this->render('register', [
            'model' => $model,
        ]);
    }
    
    /**
     * Set appropriate layout based on user authentication status
     * This runs before every action in this controller
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // For logged-in users, default to main_wide layout, but allow specific actions to override
            if (!Yii::$app->user->isGuest && !in_array($action->id, ['login', 'register'])) {
                $this->layout = 'main_wide';
            }
            return true;
        }
        return false;
    }

    /**
     * Displays services page.
     *
     * @return string
     */
    public function actionServices()
    {
        return $this->render('//website/bodies/services');
    }
    
    /**
     * Displays terms page.
     *
     * @return string
     */
    public function actionTerms()
    {
        return $this->render('//website/bodies/terms');
    }

    /**
     * Displays profile page and handles profile updates.
     *
     * @return Response|string
     */ 
public function actionProfile()
{
    // Only accessible for logged-in users
    if (Yii::$app->user->isGuest) {
        return $this->redirect(['site/login']);
    }
    
    $model = User::findOne(Yii::$app->user->id);
    $passwordForm = new PasswordChangeForm();
    
    // Handle regular profile form submission
    if (Yii::$app->request->post('User') && $model->load(Yii::$app->request->post())) {
        // Check if avatar file was uploaded
        $avatarFile = \yii\web\UploadedFile::getInstance($model, 'avatarFile');
        if ($avatarFile) {
            // Generate unique filename
            $fileName = 'avatar_' . Yii::$app->user->id . '_' . time() . '.' . $avatarFile->extension;
            $avatarPath = Yii::getAlias('@webroot/images/avatars/');
            
            // Ensure directory exists
            if (!file_exists($avatarPath)) {
                mkdir($avatarPath, 0777, true);
            }
            
            // Save file
            if ($avatarFile->saveAs($avatarPath . $fileName)) {
                // Remove old avatar if it exists
                if (!empty($model->avatar) && file_exists($avatarPath . $model->avatar)) {
                    unlink($avatarPath . $model->avatar);
                }
                $model->avatar = $fileName;
            }
        }
        
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Profile updated successfully.');
        }
        return $this->refresh();
    }
    
    // Handle password form submission
    if (Yii::$app->request->post('PasswordChangeForm') && $passwordForm->load(Yii::$app->request->post())) {
        if ($passwordForm->changePassword()) {
            Yii::$app->session->setFlash('success', 'Password updated successfully.');
            return $this->refresh();
        }
    }
    
    return $this->render('profile', [
        'model' => $model,
        'passwordForm' => $passwordForm,
    ]);
}

}
