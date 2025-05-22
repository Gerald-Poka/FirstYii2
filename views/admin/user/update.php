<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update User: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

// Register the CSS file
$this->registerCssFile('@web/css/admin/user_form.css');
// Register Bootstrap Icons
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css');
?>

<div class="user-update container-fluid py-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-white">
                        <i class="bi bi-pencil-square me-2"></i><?= Html::encode($model->username) ?>
                    </h1>
                    <p class="text-white-50 mb-0">Edit User Information</p>
                </div>
                <div class="dashboard-actions">
                    <?= Html::a('<i class="bi bi-arrow-left"></i> Return to Profile', ['/admin/user/view', 'id' => $model->id], [
                        'class' => 'btn btn-light',
                        'data-pjax' => '0'  // Disable pjax if it's enabled
                    ]) ?>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <?php $form = ActiveForm::begin([
                        'options' => ['class' => 'user-form'],
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
                        <h5 class="form-section-title"><i class="bi bi-person-vcard me-2"></i>Personal Details</h5>
                        
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                        
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'form-control']) 
                            ->hint('<small class="text-muted">We\'ll never share your email with anyone else.</small>') ?>
                        
                        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                        
                        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                    </div>
                    
                    <div class="form-section">
                        <h5 class="form-section-title"><i class="bi bi-shield-lock me-2"></i>Update Password</h5>
                        <p class="text-muted mb-3">Leave password fields empty if you don't want to change the password.</p>
                        
                        <?= $form->field($model, 'password')->passwordInput([
                            'maxlength' => true, 
                            'class' => 'form-control', 
                            'autocomplete' => 'new-password',
                            'placeholder' => 'Enter new password'
                        ])->label('New Password') ?>
                        
                        <?= $form->field($model, 'password_repeat')->passwordInput([
                            'maxlength' => true, 
                            'class' => 'form-control', 
                            'autocomplete' => 'new-password',
                            'placeholder' => 'Confirm new password'
                        ])->label('Confirm Password') ?>
                    </div>
                    
                    <div class="form-actions">
                        <div class="offset-sm-3 col-sm-9">
                            <?= Html::submitButton('<i class="bi bi-check-circle me-1"></i> Save Changes', ['class' => 'btn btn-primary btn-save']) ?>
                            <?= Html::a('<i class="bi bi-x-circle me-1"></i> Cancel', ['/admin/user/view', 'id' => $model->id], [
                                'class' => 'btn btn-outline-secondary ms-2',
                                'data-pjax' => '0'  // Disable pjax if it's enabled
                            ]) ?>
                        </div>
                    </div>
                    
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>