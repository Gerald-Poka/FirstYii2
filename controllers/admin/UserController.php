<?php

namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{
    // Set the layout for all actions in this controller
    public $layout = 'main_wide';  
    
    /**
     * Lists all normal users
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['role' => User::ROLE_USER]), // Only show normal users
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single user
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    /**
     * Creates a new user
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        // Explicitly set which attributes are safe to load
        $model->setScenario('create');

        if ($model->load(Yii::$app->request->post())) {
            // Handle avatar file upload
            $model->avatarFile = \yii\web\UploadedFile::getInstance($model, 'avatarFile');
            
            // Set required defaults
            $model->role = User::ROLE_USER;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            
            // Generate authentication keys
            $model->auth_key = Yii::$app->security->generateRandomString();
            
            // Hash password
            if (!empty($model->password)) {
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            }
            
            // Process avatar if uploaded
            if ($model->avatarFile) {
                $avatarName = 'user_' . time() . '.' . $model->avatarFile->extension;
                $model->avatar = $avatarName;
            }
            
            // Enable validation debugging
            $valid = $model->validate();
            if (!$valid) {
                Yii::error('Validation errors: ' . print_r($model->errors, true));
            }
            
            if ($model->save(false)) { // Skip validation as we already did it
                // Save the file if provided
                if ($model->avatarFile) {
                    $uploadPath = Yii::getAlias('@webroot/images/avatars/');
                    
                    // Create directory if it doesn't exist
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }
                    
                    $model->avatarFile->saveAs($uploadPath . $avatarName);
                }
                
                Yii::$app->session->setFlash('success', '<i class="bi bi-check-circle me-2"></i> New user account has been created successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', '<i class="bi bi-exclamation-triangle me-2"></i> There was an error creating the user.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing user
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // For security, you might want to add permission check here
        // if (!Yii::$app->user->can('updateUser')) { ... }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'User has been updated successfully.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing user
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // Check for self-deletion
        if (Yii::$app->user->id == $id) {
            Yii::$app->session->setFlash('error', 'You cannot delete your own account.');
            return $this->redirect(['index']);
        }
        
        try {
            $model = $this->findModel($id);
            $username = $model->username;
            
            if ($model->delete()) {
                Yii::$app->session->setFlash('success', "<i class='bi bi-check-circle'></i> User '{$username}' has been deleted successfully.");
            } else {
                Yii::$app->session->setFlash('error', "<i class='bi bi-exclamation-triangle'></i> Failed to delete user '{$username}'.");
            }
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', "<i class='bi bi-x-circle'></i> Error: " . $e->getMessage());
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested user does not exist.');
    }
}