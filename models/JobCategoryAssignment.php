<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "job_category_assignment".
 *
 * @property int $id
 * @property int $job_id
 * @property int $category_id
 * @property string $created_at
 *
 * @property Jobs $job
 * @property JobCategories $category
 */
class JobCategoryAssignment extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_category_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'category_id'], 'required'],
            [['job_id', 'category_id'], 'integer'],
            [['created_at'], 'safe'],
            [['job_id', 'category_id'], 'unique', 'targetAttribute' => ['job_id', 'category_id']],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::class, 'targetAttribute' => ['job_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobCategories::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_id' => 'Job ID',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Job]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Jobs::class, ['id' => 'job_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(JobCategories::class, ['id' => 'category_id']);
    }
}