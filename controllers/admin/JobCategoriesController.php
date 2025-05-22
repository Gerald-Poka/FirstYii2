<?php

namespace app\controllers\admin;

use Yii;
use app\models\JobCategories;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * JobCategoriesController handles job category management
 */
class JobCategoriesController extends Controller
{
    // Use the same layout as your other admin controllers
    public $layout = 'main_wide';
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // authenticated users
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all job categories
     * @return mixed
     */
    public function actionIndex()
    {
        // Create a basic data provider for categories (can replace with actual data later)
        $dataProvider = new ActiveDataProvider([
            'query' => JobCategories::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Creates a new job category
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JobCategories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Category created successfully.');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates a job category
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Category updated successfully.');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes a job category
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        // Check if any jobs are using this category
        $jobsCount = Jobs::find()->where(['category_id' => $id])->count();
        
        if ($jobsCount > 0) {
            Yii::$app->session->setFlash('error', 'Cannot delete category because it is being used by ' . $jobsCount . ' job listings.');
        } else {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Category deleted successfully.');
        }
        
        return $this->redirect(['index']);
    }

    /**
     * Toggle category status (active/inactive)
     * @param integer $id
     * @return mixed
     */
    public function actionToggleStatus($id)
    {
        $model = $this->findModel($id);
        $model->status = $model->status ? 0 : 1; // Toggle between 0 and 1
        
        if ($model->save(false)) {
            Yii::$app->session->setFlash('success', 'Category status updated successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to update category status.');
        }
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the JobCategories model based on its primary key value.
     * @param integer $id
     * @return JobCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobCategories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested category does not exist.');
    }
}