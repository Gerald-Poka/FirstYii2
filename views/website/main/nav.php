<?php
use yii\helpers\Html;
use yii\helpers\Url;

// Updated CSS path with Yii's asset manager
$this->registerCssFile(Yii::$app->request->baseUrl . '/css/web/nav.css');

// Register Font Awesome if needed
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

// Register the external JS file instead of inline JS
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/web/land.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<nav id="main-navigation">
    <div class="container">
        <div class="nav-container">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="<?= Url::home() ?>">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Url::to(['/site/about']) ?>">
                        <i class="fas fa-info-circle"></i> About
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Url::to(['/site/services']) ?>">
                        <i class="fas fa-cogs"></i> Services
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Url::to(['/site/terms']) ?>">
                        <i class="fas fa-shield-alt"></i> Terms of Service
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Url::to(['/site/contact']) ?>">
                        <i class="fas fa-envelope"></i> Contact
                    </a>
                </li>
            </ul>
            
            <!-- Replace your current mobile toggle button with this -->
            <button class="mobile-nav-toggle" aria-label="Toggle Navigation Menu">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="nav-search">
                <form action="<?= Url::to(['/site/search']) ?>" method="get">
                    <input type="text" name="q" placeholder="Search..." aria-label="Search">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</nav>