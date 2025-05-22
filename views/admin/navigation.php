<?php
use yii\helpers\Url;

// Register the dedicated CSS and JS files for admin navigation
$this->registerCssFile('@web/css/admin/navigation.css');
$this->registerJsFile('@web/js/admin/navigation.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<nav class="admin-sidebar-nav">
    <div class="admin-nav-category">Main Navigation</div>
    <ul class="admin-nav-list">
        <!-- Dashboard -->
    <li class="admin-nav-item <?= Yii::$app->controller->id == 'dashboard' && Yii::$app->controller->action->id == 'index' ? 'active' : '' ?>">
        <a href="<?= Url::to(['/admin/dashboard/index']) ?>" class="admin-nav-link">
            <i class="fas fa-tachometer-alt"></i>
            <span class="admin-nav-text">Dashboard</span>
        </a>
    </li>

        
        <!-- User Management -->
        <li class="admin-nav-item has-submenu <?= in_array(Yii::$app->controller->id, ['user', 'role']) ? 'active open' : '' ?>">
            <a href="#" class="admin-nav-link">
                <i class="fas fa-users"></i>
                <span class="admin-nav-text">User Management</span>
                <i class="fas fa-chevron-down admin-submenu-icon"></i>
            </a>
            <ul class="admin-submenu">
                <li>
                    <a href="<?= Url::to(['/admin/user/index']) ?>" class="admin-submenu-link">
                        <i class="fas fa-user-friends"></i>
                        View All Users
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/user/create']) ?>" class="admin-submenu-link">
                        <i class="fas fa-user-plus"></i>
                        Add New User
                    </a>
                </li>
            </ul>
        </li>
        
    </ul>
    
    <div class="admin-nav-category">Job Management</div>
    <ul class="admin-nav-list">
        <!-- Job Management -->
        <li class="admin-nav-item has-submenu <?= Yii::$app->controller->id == 'jobs' ? 'active open' : '' ?>">
            <a href="#" class="admin-nav-link">
                <i class="fas fa-briefcase"></i>
                <span class="admin-nav-text">Job Listings</span>
                <i class="fas fa-chevron-down admin-submenu-icon"></i>
            </a>
            <ul class="admin-submenu">
                <li>
                    <a href="<?= Url::to(['/admin/jobs/index']) ?>" class="admin-submenu-link">
                        <i class="fas fa-list"></i>
                        All Jobs
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/jobs/create']) ?>" class="admin-submenu-link">
                        <i class="fas fa-plus-circle"></i>
                        Post New Job
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/job-categories/index']) ?>" class="admin-submenu-link">
                        <i class="fas fa-folder"></i>
                        Job Categories
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/job-skills/index']) ?>" class="admin-submenu-link">
                        <i class="fas fa-tools"></i>
                        Skills & Requirements
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- Applications -->
        <li class="admin-nav-item has-submenu <?= Yii::$app->controller->id == 'applications' ? 'active open' : '' ?>">
            <a href="#" class="admin-nav-link">
                <i class="fas fa-file-alt"></i>
                <span class="admin-nav-text">Applications</span>
                <span class="admin-badge">12</span>
                <i class="fas fa-chevron-down admin-submenu-icon"></i>
            </a>
            <ul class="admin-submenu">
                <li>
                    <a href="<?= Url::to(['/admin/applications']) ?>" class="admin-submenu-link">
                        <i class="fas fa-clipboard-list"></i>
                        All Applications
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/applications/pending']) ?>" class="admin-submenu-link">
                        <i class="fas fa-hourglass-half"></i>
                        Pending Review
                        <span class="admin-badge">5</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/applications/shortlisted']) ?>" class="admin-submenu-link">
                        <i class="fas fa-star"></i>
                        Shortlisted
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/applications/rejected']) ?>" class="admin-submenu-link">
                        <i class="fas fa-times-circle"></i>
                        Rejected
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- Interview Management -->
        <li class="admin-nav-item has-submenu <?= Yii::$app->controller->id == 'interviews' ? 'active open' : '' ?>">
            <a href="#" class="admin-nav-link">
                <i class="fas fa-calendar-check"></i>
                <span class="admin-nav-text">Interviews</span>
                <span class="admin-badge">3</span>
                <i class="fas fa-chevron-down admin-submenu-icon"></i>
            </a>
            <ul class="admin-submenu">
                <li>
                    <a href="<?= Url::to(['/admin/interviews/schedule']) ?>" class="admin-submenu-link">
                        <i class="fas fa-calendar-plus"></i>
                        Schedule Interview
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/interviews/upcoming']) ?>" class="admin-submenu-link">
                        <i class="fas fa-calendar-day"></i>
                        Upcoming Interviews
                        <span class="admin-badge">3</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/interviews/feedback']) ?>" class="admin-submenu-link">
                        <i class="fas fa-comment-dots"></i>
                        Interview Feedback
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    
    <div class="admin-nav-category">System</div>
    <ul class="admin-nav-list">
        <!-- Reports & Analytics -->
        <li class="admin-nav-item has-submenu <?= Yii::$app->controller->id == 'reports' ? 'active open' : '' ?>">
            <a href="#" class="admin-nav-link">
                <i class="fas fa-chart-bar"></i>
                <span class="admin-nav-text">Reports & Analytics</span>
                <i class="fas fa-chevron-down admin-submenu-icon"></i>
            </a>
            <ul class="admin-submenu">
                <li>
                    <a href="<?= Url::to(['/admin/reports/application-stats']) ?>" class="admin-submenu-link">
                        <i class="fas fa-chart-line"></i>
                        Application Statistics
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/reports/hiring-metrics']) ?>" class="admin-submenu-link">
                        <i class="fas fa-chart-pie"></i>
                        Hiring Metrics
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/reports/candidate-sources']) ?>" class="admin-submenu-link">
                        <i class="fas fa-filter"></i>
                        Candidate Sources
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- Communications -->
        <li class="admin-nav-item has-submenu <?= Yii::$app->controller->id == 'communications' ? 'active open' : '' ?>">
            <a href="#" class="admin-nav-link">
                <i class="fas fa-envelope"></i>
                <span class="admin-nav-text">Communications</span>
                <i class="fas fa-chevron-down admin-submenu-icon"></i>
            </a>
            <ul class="admin-submenu">
                <li>
                    <a href="<?= Url::to(['/admin/communications/email-templates']) ?>" class="admin-submenu-link">
                        <i class="fas fa-envelope-open-text"></i>
                        Email Templates
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/communications/notifications']) ?>" class="admin-submenu-link">
                        <i class="fas fa-bell"></i>
                        Notification Settings
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/communications/bulk-message']) ?>" class="admin-submenu-link">
                        <i class="fas fa-paper-plane"></i>
                        Bulk Messages
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- Settings -->
        <li class="admin-nav-item has-submenu <?= Yii::$app->controller->id == 'settings' ? 'active open' : '' ?>">
            <a href="#" class="admin-nav-link">
                <i class="fas fa-cog"></i>
                <span class="admin-nav-text">System Settings</span>
                <i class="fas fa-chevron-down admin-submenu-icon"></i>
            </a>
            <ul class="admin-submenu">
                <li>
                    <a href="<?= Url::to(['/admin/settings/general']) ?>" class="admin-submenu-link">
                        <i class="fas fa-sliders-h"></i>
                        General Settings
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/settings/workflow']) ?>" class="admin-submenu-link">
                        <i class="fas fa-project-diagram"></i>
                        Application Workflow
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/settings/appearance']) ?>" class="admin-submenu-link">
                        <i class="fas fa-palette"></i>
                        Appearance
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin/settings/backup']) ?>" class="admin-submenu-link">
                        <i class="fas fa-database"></i>
                        Backup & Restore
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    
    <div class="admin-nav-category">Quick Access</div>
    <ul class="admin-nav-list">
        <!-- Calendar -->
        <li class="admin-nav-item <?= Yii::$app->controller->id == 'calendar' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/admin/calendar']) ?>" class="admin-nav-link">
                <i class="fas fa-calendar-alt"></i>
                <span class="admin-nav-text">Calendar</span>
            </a>
        </li>
        
        <!-- Help and Documentation -->
        <li class="admin-nav-item <?= Yii::$app->controller->id == 'help' ? 'active' : '' ?>">
            <a href="<?= Url::to(['/admin/help']) ?>" class="admin-nav-link">
                <i class="fas fa-question-circle"></i>
                <span class="admin-nav-text">Help & Docs</span>
            </a>
        </li>
    </ul>
</nav>


