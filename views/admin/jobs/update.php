<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Job: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Job Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

// Register CSS
$this->registerCssFile('@web/css/admin/jobs.css');
$this->registerCssFile('@web/css/admin/job_create.css');
?>

<div class="jobs-update container-fluid py-4">
    <div class="mb-3 text-end">
        <?= Html::a('<i class="bi bi-arrow-left me-1"></i> Back to Job Details', ['view', 'id' => $model->id], ['class' => 'btn btn-light']) ?>
    </div>

    <div class="card shadow mb-4 rounded-card">
        <div class="card-header py-3">
            <div>
                <h1 class="h3 mb-0 text-white d-flex align-items-center">
                    <i class="bi bi-pencil-square fs-3 me-2"></i>
                    <span><?= Html::encode($this->title) ?></span>
                </h1>
                <p class="text-white-50 mb-0 mt-2">Update job listing information</p>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <?php $form = ActiveForm::begin(['options' => ['class' => 'job-form']]); ?>

                    <div class="form-section">
                        <h2 class="form-section-title">
                            <i class="bi bi-info-circle"></i> Basic Information
                        </h2>
                        
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'job_type')->dropDownList([
                                    'Full-time' => 'Full-time',
                                    'Part-time' => 'Part-time',
                                    'Contract' => 'Contract',
                                    'Internship' => 'Internship',
                                    'Remote' => 'Remote',
                                ], ['prompt' => 'Select job type']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'salary_range')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2 class="form-section-title">
                            <i class="bi bi-file-text"></i> Job Details
                        </h2>
                        
                        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                        
                        <?= $form->field($model, 'responsibilities')->textarea(['rows' => 6]) ?>
                        
                        <?= $form->field($model, 'requirements')->textarea(['rows' => 6]) ?>
                    </div>
                    
                    <div class="form-section">
                        <h2 class="form-section-title">
                            <i class="bi bi-gear"></i> Settings
                        </h2>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'status')->dropDownList([
                                    0 => 'Draft',
                                    1 => 'Published',
                                    2 => 'Closed',
                                ], ['prompt' => 'Select status']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'expiry_date')->input('date') ?>
                            </div>
                        </div>
                        
                        <?php if (isset($categories)): ?>
                        <div class="mb-3">
                            <label class="form-label">Categories</label>
                            <div class="row">
                                <?php foreach ($categories as $category): ?>
                                <div class="col-md-4">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="JobCategories[]" value="<?= $category->id ?>" id="category_<?= $category->id ?>"
                                            <?= in_array($category->id, $selectedCategories) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="category_<?= $category->id ?>">
                                            <?= Html::encode($category->name) ?>
                                        </label>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (isset($skills)): ?>
                        <div class="mb-3">
                            <label class="form-label">Required Skills</label>
                            <div class="row">
                                <?php foreach ($skills as $skill): ?>
                                <div class="col-md-4">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="JobSkills[]" value="<?= $skill->id ?>" id="skill_<?= $skill->id ?>"
                                            <?= in_array($skill->id, $selectedSkills) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="skill_<?= $skill->id ?>">
                                            <?= Html::encode($skill->name) ?>
                                        </label>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-actions text-center mt-4">
                        <?= Html::submitButton('<i class="bi bi-save me-1"></i> Save Changes', ['class' => 'btn btn-success btn-lg px-5']) ?>
                        <?= Html::a('<i class="bi bi-x-circle me-1"></i> Cancel', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-secondary btn-lg px-5 ms-2']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$css = <<<CSS
/* Update-specific styles */
.btn-success {
    background: linear-gradient(135deg, #06d6a0, #1b9aaa);
    border: none;
    font-weight: 600;
}
.btn-success:hover {
    background: linear-gradient(135deg, #05c190, #178a99);
    box-shadow: 0 4px 12px rgba(6, 214, 160, 0.2);
}
CSS;
$this->registerCss($css);
?>