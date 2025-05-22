<?php

namespace app\controllers\admin;

use Yii;
use app\models\Jobs;
use app\models\JobCategories;
use app\models\JobSkills;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * JobsController handles job listing management
 */
class JobsController extends Controller
{
    // Match the same layout as UserController
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
                        'roles' => ['@'], // @ means authenticated users
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
     * Lists all jobs
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Jobs::find(),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => null, // You can implement a search model later
        ]);
    }

    /**
     * Displays a single job
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        // Direct SQL query to get categories (backup method)
        $directCategoryIds = Yii::$app->db->createCommand("
            SELECT category_id FROM job_category_assignment WHERE job_id = :jobId
        ", [':jobId' => $id])->queryColumn();
        
        $directCategories = [];
        if (!empty($directCategoryIds)) {
            $directCategories = JobCategories::find()->where(['id' => $directCategoryIds])->all();
        }
        
        // Direct SQL query to get skills (backup method)
        $directSkillIds = Yii::$app->db->createCommand("
            SELECT skill_id FROM job_skill_assignment WHERE job_id = :jobId
        ", [':jobId' => $id])->queryColumn();
        
        $directSkills = [];
        if (!empty($directSkillIds)) {
            $directSkills = JobSkills::find()->where(['id' => $directSkillIds])->all();
        }
        
        return $this->render('view', [
            'model' => $model,
            'directCategories' => $directCategories,
            'directSkills' => $directSkills,
        ]);
    }

    /**
     * Creates a new job
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Jobs();
        $model->created_by = Yii::$app->user->id;
        $model->status = Jobs::STATUS_DRAFT;
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                // Handle skills assignment
                $this->saveJobSkills($model->id, Yii::$app->request->post('job-skills', []));
                
                Yii::$app->session->setFlash('success', 'Job listing created successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'categories' => JobCategories::find()->all(),
            'skills' => JobSkills::find()->all(),
            'currentSkills' => [],
        ]);
    }

    /**
     * Updates an existing job
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        // Get all categories and skills
        $categories = \app\models\JobCategories::find()->all();
        $skills = \app\models\JobSkills::find()->all();
        
        // Get selected categories and skills
        $selectedCategories = [];
        $selectedSkills = [];
        
        // Get the IDs of currently selected categories
        if ($model->categories) {
            foreach ($model->categories as $category) {
                $selectedCategories[] = $category->id;
            }
        }
        
        // Get the IDs of currently selected skills
        if ($model->skills) {
            foreach ($model->skills as $skill) {
                $selectedSkills[] = $skill->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Handle job categories relation
            $postedCategories = Yii::$app->request->post('JobCategories', []);
            \app\models\JobCategoryAssignment::deleteAll(['job_id' => $model->id]);
            
            foreach ($postedCategories as $categoryId) {
                $jobCategory = new \app\models\JobCategoryAssignment();
                $jobCategory->job_id = $model->id;
                $jobCategory->category_id = $categoryId;
                $jobCategory->save();
            }
            
            // Handle job skills relation
            $postedSkills = Yii::$app->request->post('JobSkills', []);
            \app\models\JobSkillAssignment::deleteAll(['job_id' => $model->id]);
            
            foreach ($postedSkills as $skillId) {
                $jobSkill = new \app\models\JobSkillAssignment();
                $jobSkill->job_id = $model->id;
                $jobSkill->skill_id = $skillId;
                $jobSkill->save();
            }
            
            Yii::$app->session->setFlash('success', 'Job updated successfully.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
            'skills' => $skills,
            'selectedCategories' => $selectedCategories,
            'selectedSkills' => $selectedSkills,
        ]);
    }

    /**
     * Publishes a job listing
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPublish($id)
    {
        $model = $this->findModel($id);
        $model->status = Jobs::STATUS_PUBLISHED;

        if ($model->save(false)) {
            Yii::$app->session->setFlash('success', 'Job listing published successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to publish job listing.');
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Closes a job listing
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionClose($id)
    {
        $model = $this->findModel($id);
        $model->status = Jobs::STATUS_CLOSED;

        if ($model->save(false)) {
            Yii::$app->session->setFlash('success', 'Job listing closed successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to close job listing.');
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Deletes a job listing
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        Yii::$app->session->setFlash('success', 'Job listing deleted successfully.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Jobs model based on its primary key value.
     * @param integer $id
     * @return Jobs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \app\models\Jobs::findOne($id)) !== null) {
            return $model;
        }

        throw new \yii\web\NotFoundHttpException('The requested job does not exist.');
    }
    
    /**
     * Saves job skills relationships
     * @param integer $jobId
     * @param array $skillIds
     */
    protected function saveJobSkills($jobId, $skillIds)
    {
        // First, delete existing relationships
        Yii::$app->db->createCommand()->delete('job_skill_map', ['job_id' => $jobId])->execute();
        
        // Then insert new relationships
        if (!empty($skillIds)) {
            foreach ($skillIds as $skillId) {
                Yii::$app->db->createCommand()->insert('job_skill_map', [
                    'job_id' => $jobId,
                    'skill_id' => (int)$skillId,
                ])->execute();
            }
        }
    }
    
    /**
     * Gets job skills for a job
     * @param integer $jobId
     * @return array
     */
    protected function getJobSkills($jobId)
    {
        return Yii::$app->db->createCommand('
            SELECT skill_id FROM job_skill_map WHERE job_id = :jobId
        ', [':jobId' => $jobId])->queryColumn();
    }
}