<nav class="sidebar-nav">
    <ul class="nav-list">
        <li class="nav-item <?= Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/site/index']) ?>" class="nav-link">
                <i class="fas fa-home"></i>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        
        <li class="nav-item <?= Yii::$app->controller->id == 'courses' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/courses']) ?>" class="nav-link">
                <i class="fas fa-book"></i>
                <span class="nav-text">Courses</span>
            </a>
        </li>
        
        <li class="nav-item <?= Yii::$app->controller->id == 'assignments' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/assignments']) ?>" class="nav-link">
                <i class="fas fa-tasks"></i>
                <span class="nav-text">Assignments</span>
            </a>
        </li>
        
        <li class="nav-item <?= Yii::$app->controller->id == 'calendar' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/calendar']) ?>" class="nav-link">
                <i class="fas fa-calendar-alt"></i>
                <span class="nav-text">Calendar</span>
            </a>
        </li>
    </ul>
</nav>