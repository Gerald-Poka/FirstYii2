<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "interview_feedback".
 *
 * @property int $id
 * @property int $interview_id
 * @property int $evaluator_id
 * @property int $rating
 * @property string $feedback
 * @property int $recommendation
 * @property string $created_at
 *
 * @property User $evaluator
 * @property Interviews $interview
 */
class InterviewFeedback extends ActiveRecord
{
    // Recommendation constants
    const RECOMMEND_REJECT = 0;
    const RECOMMEND_CONSIDER = 1;
    const RECOMMEND_HIRE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'interview_feedback';
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
                'updatedAtAttribute' => false,
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
            [['interview_id', 'evaluator_id', 'rating', 'feedback', 'recommendation'], 'required'],
            [['interview_id', 'evaluator_id', 'recommendation'], 'integer'],
            [['rating'], 'integer', 'min' => 1, 'max' => 5],
            [['feedback'], 'string'],
            [['interview_id'], 'exist', 'skipOnError' => true, 'targetClass' => Interviews::class, 'targetAttribute' => ['interview_id' => 'id']],
            [['evaluator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['evaluator_id' => 'id']],
            ['recommendation', 'in', 'range' => [
                self::RECOMMEND_REJECT,
                self::RECOMMEND_CONSIDER,
                self::RECOMMEND_HIRE
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
            'interview_id' => 'Interview',
            'evaluator_id' => 'Evaluator',
            'rating' => 'Overall Rating',
            'feedback' => 'Detailed Feedback',
            'recommendation' => 'Recommendation',
            'created_at' => 'Submitted On',
        ];
    }

    /**
     * Gets query for [[Evaluator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluator()
    {
        return $this->hasOne(User::class, ['id' => 'evaluator_id']);
    }

    /**
     * Gets query for [[Interview]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInterview()
    {
        return $this->hasOne(Interviews::class, ['id' => 'interview_id']);
    }
    
    /**
     * Get recommendation label
     */
    public function getRecommendationLabel()
    {
        $options = [
            self::RECOMMEND_REJECT => 'Reject',
            self::RECOMMEND_CONSIDER => 'Consider',
            self::RECOMMEND_HIRE => 'Hire',
        ];
        
        return isset($options[$this->recommendation]) ? $options[$this->recommendation] : 'Unknown';
    }
    
    /**
     * Get recommendation color class
     */
    public function getRecommendationColorClass()
    {
        switch ($this->recommendation) {
            case self::RECOMMEND_REJECT:
                return 'bg-danger';
            case self::RECOMMEND_CONSIDER:
                return 'bg-warning';
            case self::RECOMMEND_HIRE:
                return 'bg-success';
            default:
                return 'bg-secondary';
        }
    }
    
    /**
     * Get rating as stars
     */
    public function getRatingStars()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            $stars .= $i <= $this->rating ? '★' : '☆';
        }
        return $stars;
    }
}