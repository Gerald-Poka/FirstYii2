<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'My Profile';
$this->params['breadcrumbs'][] = $this->title;

// Register necessary CSS
$this->registerCssFile('@web/css/profile.css');
?>

<div class="profile-page">
    <div class="profile-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Manage your account settings and profile information</p>
    </div>
    
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    
    <div class="profile-tabs">
        <ul class="nav nav-tabs" id="profileTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab">
                    <i class="fas fa-user"></i> General
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab">
                    <i class="fas fa-portrait"></i> Profile Picture
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab">
                    <i class="fas fa-key"></i> Password
                </a>
            </li>
        </ul>
        
        <div class="tab-content" id="profileTabContent">
            <!-- General Information Tab -->
            <div class="tab-pane fade show active" id="general" role="tabpanel">
                <?php $form = ActiveForm::begin(['id' => 'profile-form']); ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'disabled' => true])
                            ->hint('Username cannot be changed') ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <?= Html::submitButton('Save Changes', ['class' => 'btn btn-primary']) ?>
                </div>
                
                <?php ActiveForm::end(); ?>
            </div>
            
            <!-- Avatar Tab -->
            <div class="tab-pane fade" id="avatar" role="tabpanel">
                <?php $form = ActiveForm::begin(['id' => 'avatar-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                
                <div class="current-avatar">
                    <p>Current Profile Picture:</p>
                    <div class="avatar-preview">
                        <?php if (!empty($model->avatar)): ?>
                            <?= Html::img(Yii::getAlias('@web/images/avatars/') . $model->avatar, [
                                'class' => 'avatar-img',
                                'alt' => 'Current Avatar',
                                'onerror' => "this.onerror=null; this.src='" . Yii::getAlias('@web/images/default-avatar.png') . "';"
                            ]) ?>
                        <?php else: ?>
                            <div class="avatar-placeholder">
                                <?= strtoupper(substr($model->firstname ?? 'U', 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="upload-new">
                    <p>Upload a new image (JPG or PNG, max 2MB):</p>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="avatarFile" name="User[avatarFile]">
                        <label class="custom-file-label" for="avatarFile">Choose file</label>
                    </div>
                </div>
                
                <div class="form-group mt-4">
                    <?= Html::submitButton('Upload New Picture', ['class' => 'btn btn-primary']) ?>
                </div>
                
                <?php ActiveForm::end(); ?>
            </div>
            
            <!-- Password Tab -->
            <div class="tab-pane fade" id="password" role="tabpanel">
                <?php $form = ActiveForm::begin(['id' => 'password-form']); ?>
                
                <?= $form->field($passwordForm, 'currentPassword')->passwordInput() ?>
                
                <?= $form->field($passwordForm, 'newPassword')->passwordInput() ?>
                
                <?= $form->field($passwordForm, 'confirmPassword')->passwordInput() ?>
                
                <div class="form-group">
                    <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary']) ?>
                </div>
                
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
// Handle tab switching
$('#profileTabs a').on('click', function (e) {
    e.preventDefault();
    $(this).tab('show');
});

// Update file input label with selected filename
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\\\').pop();
    $(this).next('.custom-file-label').html(fileName);
});

// Remember active tab after page refresh
let activeTab = sessionStorage.getItem('activeProfileTab');
if (activeTab) {
    $('#profileTabs a[href="' + activeTab + '"]').tab('show');
}

$('#profileTabs a').on('shown.bs.tab', function (e) {
    sessionStorage.setItem('activeProfileTab', $(e.target).attr('href'));
});
JS;
$this->registerJs($js);
?>