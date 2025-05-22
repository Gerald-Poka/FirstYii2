<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Job Application System';


// Include the header
echo $this->render('main/header');

// Include the navigation below header
echo $this->render('main/nav');
?>

<div class="landing-wrapper">
    <?= $this->render('bodies/home') ?>
    
    <?= $this->render('bodies/features') ?>

        <!-- Floating Contact Button -->
    <div class="floating-contact-btn">
        <div class="pulse"></div>
        <i class="fas fa-comment-alt"></i>
    </div>
</div>
