<?php
use yii\helpers\Url;
?>
<nav class="sidebar-nav">
    <ul class="nav-list">
        <li class="nav-item <?= Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/site/index']) ?>" class="nav-link">
                <i class="fas fa-home"></i>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        
        <li class="nav-item <?= Yii::$app->controller->id == 'jobs' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/jobs']) ?>" class="nav-link">
                <i class="fas fa-briefcase"></i>
                <span class="nav-text">Browse Jobs</span>
            </a>
        </li>
        
        <li class="nav-item <?= Yii::$app->controller->id == 'applications' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/applications']) ?>" class="nav-link">
                <i class="fas fa-file-alt"></i>
                <span class="nav-text">My Applications</span>
            </a>
        </li>
        
        <li class="nav-item <?= Yii::$app->controller->id == 'resume' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/resume']) ?>" class="nav-link">
                <i class="fas fa-id-card"></i>
                <span class="nav-text">My Resume</span>
            </a>
        </li>
        
        <li class="nav-item <?= Yii::$app->controller->id == 'interviews' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/interviews']) ?>" class="nav-link">
                <i class="fas fa-calendar-check"></i>
                <span class="nav-text">Interviews</span>
            </a>
        </li>
        
        <li class="nav-item <?= Yii::$app->controller->id == 'saved-jobs' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/saved-jobs']) ?>" class="nav-link">
                <i class="fas fa-bookmark"></i>
                <span class="nav-text">Saved Jobs</span>
            </a>
        </li>
        
        <li class="nav-item <?= Yii::$app->controller->id == 'notifications' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/notifications']) ?>" class="nav-link">
                <i class="fas fa-bell"></i>
                <span class="nav-text">Notifications</span>
            </a>
        </li>
        
        <li class="nav-item <?= Yii::$app->controller->id == 'profile' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/profile']) ?>" class="nav-link">
                <i class="fas fa-user"></i>
                <span class="nav-text">My Profile</span>
            </a>
        </li>
    </ul>
</nav>
