<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "job_skills".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 *
 * @property Jobs[] $jobs
 */
class JobSkills extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_skills';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Skill Name',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Jobs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Jobs::class, ['id' => 'job_id'])
            ->viaTable('job_skill_map', ['skill_id' => 'id']);
    }
    
    /**
     * Get all skills for dropdown
     */
    public static function getAllForDropdown()
    {
        return self::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();
    }
}