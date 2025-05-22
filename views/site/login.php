<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

// Register the CSS file
$this->registerCssFile('@web/css/login.css');

// Register Font Awesome (for the eye icon)
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');

// Register the JavaScript file
$this->registerJsFile('@web/js/login.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p class="form-intro">Please fill out the following fields to login:</p>

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

    <div class="login-form-container">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'custom-login-form'],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'col-form-label'],
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'invalid-feedback d-block'],
            ],
        ]); ?>

        <?php if ($model->hasErrors()): ?>
            <div class="alert alert-danger error-summary">
                <p><strong>Please fix the following errors:</strong></p>
                <?= $form->errorSummary($model) ?>
            </div>
        <?php endif; ?>

        <div class="email-field-container">
            <?= $form->field($model, 'email')->textInput([
                'autofocus' => true, 
                'type' => 'email',
                'class' => 'form-control email-field',
                'placeholder' => 'Enter your email'
            ]) ?>
        </div>

        <div class="password-field-container">
            <?= $form->field($model, 'password', [
                'options' => ['class' => 'form-group password-field-wrapper'],
                'template' => "{label}\n<div class=\"password-input-container\">{input}<span class=\"toggle-password\" title=\"Show/hide password\"><i class=\"fa fa-eye-slash\" aria-hidden=\"true\"></i></span></div>\n{error}"
            ])->passwordInput([
                'class' => 'form-control password-field',
                'placeholder' => 'Enter your password'
            ]) ?>
        </div>

        <div class="remember-me-container">
            <?= $form->field($model, 'rememberMe')->checkbox([
                'class' => 'remember-checkbox',
                'template' => "<div class=\"custom-control custom-checkbox remember-checkbox-wrapper\">{input} {label}</div>\n<div>{error}</div>",
            ]) ?>
        </div>

        <div class="form-group submit-container" style="padding-top: 15px;">
            <?= Html::submitButton('Login', [
                'class' => 'btn btn-primary login-button', 
                'name' => 'login-button',
                'type' => 'submit',
                'id' => 'login-submit-button'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="login-help-text">
            <p>You may login with <strong>admin@example.com/admin</strong> or <strong>user@example.com/user123</strong>.</p>
        </div>
        
        <div class="register-link">
            Don't have an account yet? <?= Html::a('Register here', ['site/register'], ['class' => 'register-link-text']) ?>
        </div>
    </div>
</div>
