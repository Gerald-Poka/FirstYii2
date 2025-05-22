<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;

AppAsset::register($this);

$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/web/assets/favicon.ico')]);

// Register FontAwesome for icons
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
$this->registerCssFile('@web/css/main_wide.css');
$this->registerCssFile('@web/css/footer.css');
$this->registerCssFile("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css");

// Register footer JS
$this->registerJsFile('@web/js/footer.js', ['depends' => [\yii\web\JqueryAsset::class]]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<div class="wrapper">
    <?php if (!Yii::$app->user->isGuest): ?>
        <?= $this->render('sidebar') ?>
    <?php endif; ?>

    <div class="main-content">
        <!-- Replace standard navigation with topbar -->
        <?= $this->render('topbar') ?>
        
        <main id="main" class="flex-shrink-0" role="main">
            <div class="full-width-content">
                <?php if (!empty($this->params['breadcrumbs'])): ?>
                    <div class="breadcrumbs-wrapper">
                        <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
                    </div>
                <?php endif ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
        
        <!-- Add the footer here -->
        <?= $this->render('footer') ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>