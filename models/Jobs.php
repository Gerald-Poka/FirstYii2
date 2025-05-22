<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "jobs".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $requirements
 * @property string|null $location
 * @property string $job_type
 * @property float|null $salary_min
 * @property float|null $salary_max
 * @property int $category_id
 * @property int $status
 * @property int $created_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property JobCategories $category
 * @property User $createdBy
 * @property JobSkills[] $skills
 * @property Applications[] $applications
 */
class Jobs extends ActiveRecord
{
    // Virtual attribute for skills multi-select
    public $skillIds = [];
    
    // Status constants
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_CLOSED = 2;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobs';
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
            [['title', 'description', 'job_type', 'category_id'], 'required'],
            [['description', 'requirements', 'responsibilities'], 'string'],
            [['salary_min', 'salary_max'], 'number'],
            [['category_id', 'status', 'created_by'], 'integer'],
            [['expiry_date'], 'date', 'format' => 'php:Y-m-d'],
            [['title', 'location', 'company_name'], 'string', 'max' => 255],
            [['job_type', 'salary_range'], 'string', 'max' => 100],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobCategories::class, 'targetAttribute' => ['category_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['skillIds'], 'safe'],
            ['status', 'default', 'value' => self::STATUS_DRAFT],
            ['status', 'in', 'range' => [self::STATUS_DRAFT, self::STATUS_PUBLISHED, self::STATUS_CLOSED]],
            [['salary_min', 'salary_max'], 'validateSalaryRange'],
        ];
    }

    /**
     * Custom validator for salary range
     */
    public function validateSalaryRange($attribute, $params)
    {
        if (!empty($this->salary_min) && !empty($this->salary_max)) {
            if ($this->salary_min > $this->salary_max) {
                $this->addError('salary_min', 'Minimum salary cannot be greater than maximum salary.');
                $this->addError('salary_max', 'Maximum salary cannot be less than minimum salary.');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Job Title',
            'description' => 'Job Description',
            'requirements' => 'Requirements',
            'location' => 'Location',
            'job_type' => 'Job Type',
            'salary_min' => 'Minimum Salary',
            'salary_max' => 'Maximum Salary',
            'category_id' => 'Category',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'skillIds' => 'Required Skills',
            'company_name' => 'Company Name',
            'responsibilities' => 'Responsibilities',
            'expiry_date' => 'Expiry Date',
        ];
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

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(JobCategories::className(), ['id' => 'category_id'])
            ->via('categoryAssignments');
    }

    /**
     * Gets query for [[Skills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(JobSkills::className(), ['id' => 'skill_id'])
            ->via('skillAssignments');
    }
    
    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Applications::class, ['job_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAssignments()
    {
        return $this->hasMany(JobCategoryAssignment::className(), ['job_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkillAssignments()
    {
        return $this->hasMany(JobSkillAssignment::className(), ['job_id' => 'id']);
    }

    /**
     * Get status label
     */
    public function getStatusLabel()
    {
        $statusOptions = [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PUBLISHED => 'Published',
            self::STATUS_CLOSED => 'Closed',
        ];
        
        return isset($statusOptions[$this->status]) ? $statusOptions[$this->status] : 'Unknown';
    }
    
    /**
     * Get status color class
     */
    public function getStatusColorClass()
    {
        switch ($this->status) {
            case self::STATUS_DRAFT:
                return 'bg-secondary';
            case self::STATUS_PUBLISHED:
                return 'bg-success';
            case self::STATUS_CLOSED:
                return 'bg-warning';
            default:
                return 'bg-secondary';
        }
    }
    
    /**
     * Get salary range as formatted string
     */
    public function getSalaryRange()
    {
        if (empty($this->salary_min) && empty($this->salary_max)) {
            return 'Not specified';
        }
        
        if (!empty($this->salary_min) && empty($this->salary_max)) {
            return 'From $' . number_format($this->salary_min, 2);
        }
        
        if (empty($this->salary_min) && !empty($this->salary_max)) {
            return 'Up to $' . number_format($this->salary_max, 2);
        }
        
        return '$' . number_format($this->salary_min, 2) . ' - $' . number_format($this->salary_max, 2);
    }
}