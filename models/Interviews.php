<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "interviews".
 *
 * @property int $id
 * @property int $application_id
 * @property int $scheduled_by
 * @property string $interview_date
 * @property string $location
 * @property int $status
 * @property string|null $notes
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Applications $application
 * @property User $scheduledBy
 * @property InterviewFeedback[] $feedback
 */
class Interviews extends ActiveRecord
{
    // Status constants
    const STATUS_SCHEDULED = 0;
    const STATUS_COMPLETED = 1;
    const STATUS_CANCELED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'interviews';
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
            [['application_id', 'scheduled_by', 'interview_date', 'location'], 'required'],
            [['application_id', 'scheduled_by', 'status'], 'integer'],
            [['interview_date'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['notes'], 'string'],
            [['location'], 'string', 'max' => 255],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => Applications::class, 'targetAttribute' => ['application_id' => 'id']],
            [['scheduled_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['scheduled_by' => 'id']],
            ['status', 'default', 'value' => self::STATUS_SCHEDULED],
            ['status', 'in', 'range' => [
                self::STATUS_SCHEDULED, 
                self::STATUS_COMPLETED, 
                self::STATUS_CANCELED
            ]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'application_id' => 'Application',
            'scheduled_by' => 'Scheduled By',
            'interview_date' => 'Interview Date & Time',
            'location' => 'Location/Meeting Link',
            'status' => 'Interview Status',
            'notes' => 'Notes',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Application]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(Applications::class, ['id' => 'application_id']);
    }

    /**
     * Gets query for [[ScheduledBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScheduledBy()
    {
        return $this->hasOne(User::class, ['id' => 'scheduled_by']);
    }
    
    /**
     * Gets query for [[Feedback]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedback()
    {
        return $this->hasMany(InterviewFeedback::class, ['interview_id' => 'id']);
    }
    
    /**
     * Get status label
     */
    public function getStatusLabel()
    {
        $statusOptions = [
            self::STATUS_SCHEDULED => 'Scheduled',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELED => 'Canceled',
        ];
        
        return isset($statusOptions[$this->status]) ? $statusOptions[$this->status] : 'Unknown';
    }
    
    /**
     * Get status color class
     */
    public function getStatusColorClass()
    {
        switch ($this->status) {
            case self::STATUS_SCHEDULED:
                return 'bg-info';
            case self::STATUS_COMPLETED:
                return 'bg-success';
            case self::STATUS_CANCELED:
                return 'bg-danger';
            default:
                return 'bg-secondary';
        }
    }
    
    /**
     * Check if interview is upcoming
     */
    public function getIsUpcoming()
    {
        return $this->status === self::STATUS_SCHEDULED && 
               strtotime($this->interview_date) > time();
    }
}