<?php
use yii\helpers\Html;
use yii\helpers\Url;

// Register the JavaScript file
$this->registerJsFile('@web/js/side.js', ['depends' => [\yii\web\JqueryAsset::class]]);

// Get user role (default to normal user if not set)
$userRole = Yii::$app->user->isGuest ? null : (Yii::$app->user->identity->role ?? 10);

// Debug the role detection
Yii::debug("User role detected: " . ($userRole ?? 'Guest'));
?>

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo-container">
            <?= Html::img('@web/web/assets/logo.PNG', ['class' => 'logo-image', 'alt' => 'Logo']) ?>
            <span class="logo-text">Application</span>
        </div>
    </div>
    
    <?php if (!Yii::$app->user->isGuest): ?>
    <div class="user-profile">
        <div class="profile-image">
            <?php
            // Debug info - will show in debug toolbar or logs
            if (isset(Yii::$app->user->identity->avatar)) {
                Yii::debug("Avatar in DB: " . Yii::$app->user->identity->avatar);
            }
            
            // Check if user is logged in and has an avatar filename stored
            if (!empty(Yii::$app->user->identity->avatar)):
                // Construct proper path to avatar file
                $avatarUrl = Yii::getAlias('@web/images/avatars/') . Yii::$app->user->identity->avatar;
                Yii::debug("Avatar URL constructed: $avatarUrl");
            ?>
                <?= Html::img($avatarUrl, [
                    'class' => 'avatar-img', 
                    'alt' => 'Profile picture',
                    'onerror' => "this.onerror=null; this.src='" . Yii::getAlias('@web/images/default-avatar.png') . "'; this.classList.add('default-avatar');"
                ]) ?>
            <?php else: ?>
                <div class="avatar-placeholder">
                    <?= strtoupper(substr(Yii::$app->user->identity->firstname ?? 'U', 0, 1)) ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="user-info">
            <div class="user-name" style="color: var(--text-color, #ffffff);"><?= Html::encode(Yii::$app->user->identity->username ?? 'User') ?></div>
            <div class="user-role">
                <?= $userRole == 20 ? 'Administrator' : 'Member' ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php 
    // Load navigation based on user role
    if (!Yii::$app->user->isGuest) {
        if ($userRole == 20) {
            // Admin navigation
            try {
                echo $this->render('//admin/navigation');
            } catch (\Exception $e) {
                Yii::error("Could not load admin navigation: " . $e->getMessage());
                // Fall back to default navigation if admin navigation fails
                echo $this->render('//layouts/_default_navigation');
            }
        } else {
            // Normal user navigation
            try {
                echo $this->render('//normal/navigation');
            } catch (\Exception $e) {
                Yii::error("Could not load normal user navigation: " . $e->getMessage());
                // Fall back to default navigation if normal navigation fails
                echo $this->render('//layouts/_default_navigation');
            }
        }
    } else {
        // Guest navigation
    ?>
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item <?= Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index' ? 'active' : '' ?>">
                    <a href="<?= Url::to(['/site/index']) ?>" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= Url::to(['/site/login']) ?>" class="nav-link">
                        <i class="fas fa-sign-in-alt"></i>
                        <span class="nav-text">Login</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= Url::to(['/site/register']) ?>" class="nav-link">
                        <i class="fas fa-user-plus"></i>
                        <span class="nav-text">Register</span>
                    </a>
                </li>
            </ul>
        </nav>
    <?php 
    }
    ?>
    
    <?php if (!Yii::$app->user->isGuest): ?>
    <div class="sidebar-footer">
        <a href="<?= Url::to(['/site/logout']) ?>" class="footer-link" data-method="post">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        <a href="<?= Url::to(['/site/help']) ?>" class="footer-link">
            <i class="fas fa-question-circle"></i>
            <span>Help</span>
        </a>
    </div>
    <?php endif; ?>
</div>
