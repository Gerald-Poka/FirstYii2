<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "job_skill_assignment".
 *
 * @property int $id
 * @property int $job_id
 * @property int $skill_id
 * @property string $created_at
 *
 * @property Jobs $job
 * @property JobSkills $skill
 */
class JobSkillAssignment extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_skill_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'skill_id'], 'required'],
            [['job_id', 'skill_id'], 'integer'],
            [['created_at'], 'safe'],
            [['job_id', 'skill_id'], 'unique', 'targetAttribute' => ['job_id', 'skill_id']],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::class, 'targetAttribute' => ['job_id' => 'id']],
            [['skill_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobSkills::class, 'targetAttribute' => ['skill_id' => 'id']],
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
            'skill_id' => 'Skill ID',
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
     * Gets query for [[Skill]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(JobSkills::class, ['id' => 'skill_id']);
    }
}