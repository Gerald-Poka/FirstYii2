<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "job_categories".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $status
 *
 * @property Jobs[] $jobs
 */
class JobCategories extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_INACTIVE, self::STATUS_ACTIVE]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Category Name',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Jobs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Jobs::class, ['category_id' => 'id']);
    }
    
    /**
     * Get status label
     */
    public function getStatusLabel()
    {
        return $this->status == self::STATUS_ACTIVE ? 'Active' : 'Inactive';
    }
    
    /**
     * Get active categories for dropdown
     */
    public static function getActiveForDropdown()
    {
        return self::find()
            ->where(['status' => self::STATUS_ACTIVE])
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();
    }
}