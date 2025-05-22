<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <p class="form-intro">Please fill out the following fields to register:</p>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="register-form-container">
            <?php $form = ActiveForm::begin([
                'id' => 'register-form',
                'options' => ['enctype' => 'multipart/form-data', 'class' => 'custom-register-form'],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-form-label'],
                    'inputOptions' => ['class' => 'form-control'],
                    'errorOptions' => ['class' => 'invalid-feedback d-block'],
                ],
                'validateOnSubmit' => true,
                'validateOnChange' => true,
            ]); ?>

            <?php if ($model->hasErrors()): ?>
                <div class="alert alert-danger error-summary">
                    <p><strong>Please fix the following errors:</strong></p>
                    <?= $form->errorSummary($model) ?>
                </div>
            <?php endif; ?>

            <div class="row name-fields">
                <div>
                    <?= $form->field($model, 'firstname')->textInput(['autofocus' => true, 'class' => 'form-control firstname-field']) ?>
                </div>
                <div>
                    <?= $form->field($model, 'lastname')->textInput(['class' => 'form-control lastname-field']) ?>
                </div>
            </div>

            <?= $form->field($model, 'email', ['options' => ['class' => 'form-group email-field-container']])->textInput(['type' => 'email', 'class' => 'form-control email-field']) ?>

            <?= $form->field($model, 'password', ['options' => ['class' => 'form-group password-field-container']])->passwordInput(['class' => 'form-control password-field']) ?>

            <?= $form->field($model, 'password_repeat', ['options' => ['class' => 'form-group password-confirm-container']])->passwordInput(['class' => 'form-control password-confirm-field']) ?>

            <div class="avatar-upload-container">
                <?= $form->field($model, 'avatarFile', ['options' => ['class' => 'form-group avatar-field-container']])->fileInput(['class' => 'form-control avatar-field']) ?>
                <div class="form-text text-muted avatar-help">
                    Upload a profile picture (optional). Maximum size: 2MB. Allowed formats: JPG, JPEG, PNG.
                </div>
            </div>

            <?= $form->field($model, 'terms', ['options' => ['class' => 'form-group terms-container']])->checkbox([
                'class' => 'terms-checkbox',
                'template' => "<div class=\"custom-control custom-checkbox terms-checkbox-wrapper\">{input} {label}</div>\n<div>{error}</div>",
            ]) ?>

            <div class="form-group mt-3 submit-container">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary register-button', 'name' => 'register-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <div class="mt-3 login-link">
                Already have an account? <?= Html::a('Login', ['site/login'], ['class' => 'login-link-text']) ?>
            </div>
        </div>
    </div>
</div>
