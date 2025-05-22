<?php
use yii\helpers\Html;
use yii\helpers\Url;

// Register header-specific CSS
$this->registerCssFile('@web/css/web/header.css');
// Register FontAwesome
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
?>

<header id="main-header">
    <div class="container">
        <div class="header-content">
            <div class="logo-area">
                <a href="<?= Url::home() ?>" class="logo">
                    <img src="<?= Yii::getAlias('@web/web/assets/logo.png') ?>" alt="Learning System" 
                         onerror="this.onerror=null; this.src='<?= Yii::getAlias('@web/images/default-logo.png') ?>';">
                    <span class="logo-text">Job Application System</span>
                </a>
            </div>
            
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>geraldndyamukama39@gmail.com</span>
                </div>
                <div class="contact-item">
                    <i class="fab fa-whatsapp"></i>
                    <span>0754318464</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Dar es Salaam, Tanzania</span>
                </div>
            </div>
            
            <div class="auth-area">
                <?= Html::a('Login', ['/site/login'], ['class' => 'btn btn-outline-primary']) ?>
                <?= Html::a('Register', ['/site/register'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</header>