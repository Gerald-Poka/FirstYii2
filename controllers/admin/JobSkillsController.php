<?php

namespace app\controllers\admin;

use Yii;
use app\models\JobSkills;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * JobSkillsController handles job skills management
 */
class JobSkillsController extends Controller
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
     * Lists all job skills
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => JobSkills::find(),
            'sort' => ['defaultOrder' => ['name' => SORT_ASC]],
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new job skill
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JobSkills();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Skill created successfully.');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates a job skill
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Skill updated successfully.');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes a job skill
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', 'Skill deleted successfully.');
        } catch (\yii\db\Exception $e) {
            Yii::$app->session->setFlash('error', 'Cannot delete this skill because it is being used by one or more job listings.');
        }
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the JobSkills model based on its primary key value.
     * @param integer $id
     * @return JobSkills the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobSkills::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested skill does not exist.');
    }
}