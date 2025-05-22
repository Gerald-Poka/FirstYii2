<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <!-- Get started button with login/register buttons -->
        <div class="d-flex justify-content-center gap-3 mb-4">
            <a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a>
        </div>

        <!-- Auth buttons - prominently displayed -->
        <div class="auth-buttons mt-4">
            <?= Html::a('Register', ['/site/register'], ['class' => 'btn btn-primary me-3']) ?>
            <?= Html::a('Login', ['/site/login'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>

    <div class="hero-section py-5 text-center bg-light">
        <div class="container">
            <h1 class="display-4 fw-bold">Welcome to My Application</h1>
            <p class="lead mb-4">The modern solution for your learning needs</p>

            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center mb-5">
                <?= Html::a('Register Now', ['/site/register'], ['class' => 'btn btn-primary btn-lg px-4 me-sm-3']) ?>
                <?= Html::a('Login', ['/site/login'], ['class' => 'btn btn-outline-secondary btn-lg px-4']) ?>
            </div>

            <img src="<?= Yii::getAlias('@web/images/hero-image.jpg') ?>" class="img-fluid rounded shadow"
                alt="Hero image" width="700">
        </div>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4 mb-3">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/doc/">Yii Documentation &raquo;</a>
                </p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/forum/">Yii Forum &raquo;</a>
                </p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a>
                </p>
            </div>
        </div>
    </div>
</div>
