<?php
use yii\helpers\Html;

$this->title = 'Admin Dashboard';
$this->params['breadcrumbs'][] = $this->title;

// Register the CSS file
$this->registerCssFile('@web/css/admin/dashboard.css');
?>

<div class="admin-dashboard">
    <div class="dashboard-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <p class="dashboard-subtitle">Welcome to the administration panel</p>
    </div>

    <div class="dashboard-stats-container">
        <div class="dashboard-stat-card">
            <div class="stat-card-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-value">42</div>
                <div class="stat-card-label">Active Jobs</div>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="stat-card-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-value">156</div>
                <div class="stat-card-label">Applications</div>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="stat-card-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-value">897</div>
                <div class="stat-card-label">Registered Users</div>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="stat-card-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-value">12</div>
                <div class="stat-card-label">Scheduled Interviews</div>
            </div>
        </div>
    </div>

    <div class="dashboard-widgets-container">
        <div class="dashboard-widget">
            <div class="widget-header">
                <h3>Recent Applications</h3>
                <a href="<?= \yii\helpers\Url::to(['/admin/applications']) ?>" class="widget-view-all">View All</a>
            </div>
            <div class="widget-content">
                <table class="widget-table">
                    <thead>
                        <tr>
                            <th>Applicant</th>
                            <th>Position</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Smith</td>
                            <td>Senior Developer</td>
                            <td>May 18, 2025</td>
                            <td><span class="status-badge pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>Maria Garcia</td>
                            <td>UX Designer</td>
                            <td>May 17, 2025</td>
                            <td><span class="status-badge shortlisted">Shortlisted</span></td>
                        </tr>
                        <tr>
                            <td>Robert Johnson</td>
                            <td>Product Manager</td>
                            <td>May 15, 2025</td>
                            <td><span class="status-badge rejected">Rejected</span></td>
                        </tr>
                        <tr>
                            <td>Emily Chen</td>
                            <td>Marketing Specialist</td>
                            <td>May 15, 2025</td>
                            <td><span class="status-badge pending">Pending</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="dashboard-widget">
            <div class="widget-header">
                <h3>Upcoming Interviews</h3>
                <a href="<?= \yii\helpers\Url::to(['/admin/interviews/upcoming']) ?>" class="widget-view-all">View All</a>
            </div>
            <div class="widget-content">
                <div class="interview-card">
                    <div class="interview-date">May 22, 2025</div>
                    <div class="interview-details">
                        <h4>Maria Garcia - UX Designer</h4>
                        <p><i class="fas fa-clock"></i> 10:00 AM - 11:30 AM</p>
                        <p><i class="fas fa-user"></i> Interviewer: James Wilson</p>
                    </div>
                </div>
                <div class="interview-card">
                    <div class="interview-date">May 23, 2025</div>
                    <div class="interview-details">
                        <h4>Alex Wong - Frontend Developer</h4>
                        <p><i class="fas fa-clock"></i> 2:00 PM - 3:30 PM</p>
                        <p><i class="fas fa-user"></i> Interviewer: Sarah Parker</p>
                    </div>
                </div>
                <div class="interview-card">
                    <div class="interview-date">May 24, 2025</div>
                    <div class="interview-details">
                        <h4>Jennifer Lee - Content Strategist</h4>
                        <p><i class="fas fa-clock"></i> 11:00 AM - 12:30 PM</p>
                        <p><i class="fas fa-user"></i> Interviewer: Michael Brown</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>