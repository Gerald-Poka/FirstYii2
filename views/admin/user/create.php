<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Add New User';
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Register the CSS file
$this->registerCssFile('@web/css/admin/user_form.css');
// Register Bootstrap Icons
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css');
?>

<div class="user-create container-fluid py-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-white">
                        <i class="bi bi-person-plus me-2"></i><?= Html::encode($this->title) ?>
                    </h1>
                    <p class="text-white-50 mb-0">Create a new user account</p>
                </div>
                <div class="dashboard-actions">
                    <?= Html::a('<i class="bi bi-arrow-left"></i> Back to Users', ['index'], ['class' => 'btn btn-light']) ?>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <?php $form = ActiveForm::begin([
                        'options' => [
                            'class' => 'user-form',
                            'enctype' => 'multipart/form-data' // Important for file uploads
                        ],
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
                        <h5 class="form-section-title"><i class="bi bi-person-vcard me-2"></i>User Information</h5>
                        
                        <?= $form->field($model, 'username')->textInput([
                            'maxlength' => true, 
                            'class' => 'form-control',
                            'placeholder' => 'Username'
                        ])->hint('<small class="text-muted">Username must be unique and contain only letters, numbers and underscores.</small>') ?>
                        
                        <?= $form->field($model, 'email')->textInput([
                            'maxlength' => true, 
                            'class' => 'form-control',
                            'placeholder' => 'Email address'
                        ])->hint('<small class="text-muted">We\'ll never share the email with anyone else.</small>') ?>
                        
                        <?= $form->field($model, 'firstname')->textInput([
                            'maxlength' => true, 
                            'class' => 'form-control',
                            'placeholder' => 'First name'
                        ]) ?>
                        
                        <?= $form->field($model, 'lastname')->textInput([
                            'maxlength' => true, 
                            'class' => 'form-control',
                            'placeholder' => 'Last name'
                        ]) ?>
                    </div>
                    
                    <!-- New Avatar Upload Section -->
                    <div class="form-section">
                        <h5 class="form-section-title"><i class="bi bi-image me-2"></i>Profile Picture</h5>
                        
                        <?= $form->field($model, 'avatarFile')->fileInput([
                            'class' => 'form-control',
                            'accept' => 'image/*'
                        ])->hint('<small class="text-muted">Allowed formats: JPG, PNG, GIF. Max file size: 2MB.</small>') ?>
                        
                        <div class="offset-sm-3 col-sm-9 mt-3">
                            <div class="avatar-preview-container">
                                <div class="avatar-preview">
                                    <img src="<?= Yii::getAlias('@web/images/default-avatar.png') ?>" id="avatar-preview-image" class="img-fluid rounded-circle" alt="Avatar Preview">
                                </div>
                                <div class="avatar-preview-text">Preview</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h5 class="form-section-title"><i class="bi bi-shield-lock me-2"></i>Security</h5>
                        
                        <?= $form->field($model, 'password')->passwordInput([
                            'maxlength' => true, 
                            'class' => 'form-control', 
                            'autocomplete' => 'new-password',
                            'placeholder' => 'Enter password'
                        ])->hint('<small class="text-muted">Password should be at least 6 characters long.</small>') ?>
                        
                        <?= $form->field($model, 'password_repeat')->passwordInput([
                            'maxlength' => true, 
                            'class' => 'form-control', 
                            'autocomplete' => 'new-password',
                            'placeholder' => 'Confirm password'
                        ]) ?>
                    </div>
                    
                    <div class="form-actions">
                        <div class="offset-sm-3 col-sm-9">
                            <?= Html::submitButton('<i class="bi bi-person-plus-fill me-1"></i> Create User', ['class' => 'btn btn-primary btn-save']) ?>
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
// Add JavaScript for the avatar preview
$script = <<<JS
$(document).ready(function() {
    // File input change handler
    $('#user-avatarfile').on('change', function() {
        var input = this;
        
        if (input.files && input.files[0]) {
            // Check file size
            if (input.files[0].size > 2 * 1024 * 1024) {
                alert('File is too large! Maximum size is 2MB.');
                $(this).val(''); // Clear the file input
                return;
            }
            
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#avatar-preview-image').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    });
});
JS;
$this->registerJs($script);
?>