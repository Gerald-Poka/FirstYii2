<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "applications".
 *
 * @property int $id
 * @property int $job_id
 * @property int $user_id
 * @property string|null $cover_letter
 * @property string|null $resume_path
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Jobs $job
 * @property User $user
 * @property Interviews[] $interviews
 */
class Applications extends ActiveRecord
{
    // Status constants
    const STATUS_PENDING = 0;
    const STATUS_SHORTLISTED = 1;
    const STATUS_REJECTED = 2;
    const STATUS_HIRED = 3;
    
    // File upload property
    public $resumeFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'applications';
    }
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'user_id'], 'required'],
            [['job_id', 'user_id', 'status'], 'integer'],
            [['cover_letter'], 'string'],
            [['resume_path'], 'string', 'max' => 255],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::class, 'targetAttribute' => ['job_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            ['status', 'default', 'value' => self::STATUS_PENDING],
            ['status', 'in', 'range' => [
                self::STATUS_PENDING, 
                self::STATUS_SHORTLISTED, 
                self::STATUS_REJECTED, 
                self::STATUS_HIRED
            ]],
            [['resumeFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, doc, docx'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_id' => 'Job',
            'user_id' => 'Applicant',
            'cover_letter' => 'Cover Letter',
            'resume_path' => 'Resume',
            'status' => 'Application Status',
            'created_at' => 'Applied On',
            'updated_at' => 'Last Updated',
            'resumeFile' => 'Resume',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    
    /**
     * Gets query for [[Interviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInterviews()
    {
        return $this->hasMany(Interviews::class, ['application_id' => 'id']);
    }
    
    /**
     * Get status label
     */
    public function getStatusLabel()
    {
        $statusOptions = [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_SHORTLISTED => 'Shortlisted',
            self::STATUS_REJECTED => 'Rejected',
            self::STATUS_HIRED => 'Hired',
        ];
        
        return isset($statusOptions[$this->status]) ? $statusOptions[$this->status] : 'Unknown';
    }
    
    /**
     * Get status color class
     */
    public function getStatusColorClass()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'bg-warning';
            case self::STATUS_SHORTLISTED:
                return 'bg-info';
            case self::STATUS_REJECTED:
                return 'bg-danger';
            case self::STATUS_HIRED:
                return 'bg-success';
            default:
                return 'bg-secondary';
        }
    }
}