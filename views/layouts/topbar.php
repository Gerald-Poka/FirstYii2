<?php

use yii\helpers\Html;
use yii\helpers\Url;

// Register the CSS file
$this->registerCssFile('@web/css/topbar.css');
?>

<div class="topbar">
    <div class="topbar-left">
        <!-- <div class="app-title">
            <?= Yii::$app->name ?>
        </div> -->
        <button class="toggle-sidebar" id="toggle-sidebar" style="color: white; background-color: #222; border-color: #444;">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    
    <div class="topbar-right">
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="topbar-user-dropdown">
                <button class="user-dropdown-toggle" id="userDropdownToggle">
                    <div class="user-avatar">
                        <?php if (!empty(Yii::$app->user->identity->avatar)): ?>
                            <?php $avatarUrl = Yii::getAlias('@web/images/avatars/') . Yii::$app->user->identity->avatar; ?>
                            <img src="<?= $avatarUrl ?>" alt="User Avatar" 
                                onerror="this.onerror=null; this.src='<?= Yii::getAlias('@web/images/default-avatar.png') ?>';">
                        <?php else: ?>
                            <span class="avatar-initial"><?= strtoupper(substr(Yii::$app->user->identity->firstname ?? 'U', 0, 1)) ?></span>
                        <?php endif; ?>
                    </div>
                    <span class="user-name"><?= Html::encode(Yii::$app->user->identity->username ?? 'User') ?></span>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </button>
                
                <div class="dropdown-menu" id="userDropdownMenu">
                    <div class="dropdown-header">
                        <span>Account</span>
                    </div>
                    <a href="<?= Url::to(['/site/profile']) ?>" class="dropdown-item">
                        <i class="fas fa-user-cog"></i>
                        <span>My Profile</span>
                    </a>
                    <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'dropdown-logout-form']) ?>
                        <?= Html::submitButton(
                            '<i class="fas fa-sign-out-alt"></i><span>Logout</span>',
                            ['class' => 'dropdown-item logout-btn']
                        ) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        <?php else: ?>
            <div class="auth-buttons">
                <a href="<?= Url::to(['/site/login']) ?>" class="auth-button login">Login</a>
                <a href="<?= Url::to(['/site/register']) ?>" class="auth-button register">Register</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle dropdown menu
    const userDropdownToggle = document.getElementById('userDropdownToggle');
    const userDropdownMenu = document.getElementById('userDropdownMenu');
    
    if (userDropdownToggle && userDropdownMenu) {
        userDropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            userDropdownMenu.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdownToggle.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                userDropdownMenu.classList.remove('show');
            }
        });
    }
});
</script>