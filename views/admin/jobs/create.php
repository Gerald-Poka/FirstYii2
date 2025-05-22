<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Jobs */

$this->title = 'Post New Job';
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Register CSS
$this->registerCssFile('@web/css/admin/jobs.css');
$this->registerCssFile('@web/css/admin/job_create.css');
?>

<div class="jobs-create container-fluid py-4">
    <div class="mb-3 text-end">
        <?= Html::a('<i class="bi bi-arrow-left"></i> Back to Jobs', ['index'], ['class' => 'btn btn-light']) ?>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <div>
                <h1 class="h3 mb-0 text-white">
                    <i class="bi bi-plus-circle me-2"></i><?= Html::encode($this->title) ?>
                </h1>
                <p class="text-white-50 mb-0">Add a new job listing</p>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <?php $form = ActiveForm::begin([
                        'options' => ['class' => 'job-form'],
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                            'horizontalCssClasses' => [
                                'label' => 'col-sm-3 col-form-label',
                                'wrapper' => 'col-sm-9',
                                'error' => '',
                                'hint' => '',
                            ],
                        ],
                    ]); ?>

                    <div class="form-section">
                        <h5 class="form-section-title"><i class="bi bi-info-circle me-2"></i>Basic Information</h5>
                        
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        
                        <?= $form->field($model, 'company_name')->textInput(['maxlength' => true, 'placeholder' => 'Company posting this job']) ?>

                        <?= $form->field($model, 'job_type')->dropDownList([
                            'Full-time' => 'Full-time',
                            'Part-time' => 'Part-time',
                            'Contract' => 'Contract',
                            'Internship' => 'Internship',
                            'Remote' => 'Remote',
                        ]) ?>
                        
                        <?= $form->field($model, 'location')->textInput(['maxlength' => true, 'placeholder' => 'City, Country or Remote']) ?>
                        
                        <?= $form->field($model, 'category_id')->dropDownList(
                            \yii\helpers\ArrayHelper::map($categories, 'id', 'name'),
                            ['prompt' => '-- Select Category --']
                        ) ?>
                    </div>
                    
                    <div class="form-section">
                        <h5 class="form-section-title"><i class="bi bi-currency-dollar me-2"></i>Compensation</h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'salary_min', [
                                    'horizontalCssClasses' => [
                                        'label' => 'col-sm-6 col-form-label',
                                        'wrapper' => 'col-sm-6',
                                    ]
                                ])->textInput(['type' => 'number']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'salary_max', [
                                    'horizontalCssClasses' => [
                                        'label' => 'col-sm-6 col-form-label',
                                        'wrapper' => 'col-sm-6',
                                    ]
                                ])->textInput(['type' => 'number']) ?>
                            </div>
                        </div>
                        
                        <?= $form->field($model, 'salary_range')->textInput([
                            'maxlength' => true, 
                            'placeholder' => 'e.g. $50,000 - $70,000 per year or Competitive'
                        ])->hint('Optional: Provide a formatted salary range to display') ?>
                    </div>
                    
                    <div class="form-section">
                        <h5 class="form-section-title"><i class="bi bi-file-earmark-text me-2"></i>Job Details</h5>
                        
                        <?= $form->field($model, 'description')->textarea([
                            'rows' => 6,
                            'placeholder' => 'Provide a compelling overview of this position'
                        ]) ?>
                        
                        <?= $form->field($model, 'responsibilities')->textarea([
                            'rows' => 6,
                            'placeholder' => 'List the key responsibilities for this role'
                        ]) ?>
                        
                        <?= $form->field($model, 'requirements')->textarea([
                            'rows' => 6,
                            'placeholder' => 'List the skills, qualifications and experience required'
                        ]) ?>
                        
                        <?php
                        // Skills multi-select
                        echo $form->field($model, 'skillIds')->checkboxList(
                            \yii\helpers\ArrayHelper::map($skills, 'id', 'name'),
                            [
                                'item' => function($index, $label, $name, $checked, $value) use ($currentSkills) {
                                    $checked = !empty($currentSkills) && in_array($value, $currentSkills) ? 'checked' : $checked;
                                    $return = '<div class="form-check">';
                                    $return .= '<input class="form-check-input" type="checkbox" name="Jobs[skillIds][]" value="' . $value . '" id="skill-' . $value . '" ' . $checked . '>';
                                    $return .= '<label class="form-check-label" for="skill-' . $value . '">' . $label . '</label>';
                                    $return .= '</div>';
                                    return $return;
                                }
                            ]
                        )->label('Required Skills');
                        ?>
                    </div>
                    
                    <div class="form-section">
                        <h5 class="form-section-title"><i class="bi bi-gear me-2"></i>Status & Settings</h5>
                        
                        <?= $form->field($model, 'status')->dropDownList([
                            0 => 'Draft - Save but don\'t publish',
                            1 => 'Published - Live on job board',
                            2 => 'Closed - No longer accepting applications'
                        ]) ?>

                        <?= $form->field($model, 'expiry_date')->input('date', ['class' => 'form-control'])
                            ->hint('When this job posting should expire and no longer accept applications') ?>
                    </div>
                    
                    <div class="form-actions">
                        <div class="offset-sm-3 col-sm-9">
                            <?= Html::submitButton('<i class="bi bi-check-circle me-1"></i> Save Job', ['class' => 'btn btn-primary btn-save']) ?>
                            <?= Html::a('<i class="bi bi-x-circle me-1"></i> Cancel', ['index'], [
                                'class' => 'btn btn-outline-secondary ms-2'
                            ]) ?>
                        </div>
                    </div>
                    
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Add form validation and enhancement scripts
$js = <<<JS
$(document).ready(function() {
    // Initialize any form enhancements
    $('.form-section').addClass('animate__animated animate__fadeIn');
    
    // Autogenerate salary range when min and max are provided
    $('#jobs-salary_min, #jobs-salary_max').on('change', function() {
        var min = $('#jobs-salary_min').val();
        var max = $('#jobs-salary_max').val();
        
        if (min && max) {
            var formattedMin = parseFloat(min).toLocaleString('en-US');
            var formattedMax = parseFloat(max).toLocaleString('en-US');
            $('#jobs-salary_range').val('$' + formattedMin + ' - $' + formattedMax);
        }
    });
});
JS;
$this->registerJs($js);
?>