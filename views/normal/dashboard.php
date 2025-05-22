<?php

use yii\helpers\Html;

$this->title = 'User Dashboard';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="user-dashboard">
    <div class="dashboard-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <p class="dashboard-subtitle">Welcome to your personal dashboard</p>
    </div>

    <div class="dashboard-stats-container">
        <div class="dashboard-stat-card">
            <div class="stat-card-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-value">5</div>
                <div class="stat-card-label">My Applications</div>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="stat-card-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-value">2</div>
                <div class="stat-card-label">Upcoming Interviews</div>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="stat-card-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-value">8</div>
                <div class="stat-card-label">Saved Jobs</div>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="stat-card-icon">
                <i class="fas fa-bell"></i>
            </div>
            <div class="stat-card-content">
                <div class="stat-card-value">3</div>
                <div class="stat-card-label">New Notifications</div>
            </div>
        </div>
    </div>

    <div class="dashboard-widgets-container">
        <div class="dashboard-widget">
            <div class="widget-header">
                <h3>My Recent Applications</h3>
                <a href="<?= \yii\helpers\Url::to(['/normal/applications']) ?>" class="widget-view-all">View All</a>
            </div>
            <div class="widget-content">
                <table class="widget-table">
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>Company</th>
                            <th>Date Applied</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Frontend Developer</td>
                            <td>Tech Solutions Inc</td>
                            <td>May 18, 2025</td>
                            <td><span class="status-badge pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>Web Designer</td>
                            <td>Creative Agency</td>
                            <td>May 15, 2025</td>
                            <td><span class="status-badge shortlisted">Shortlisted</span></td>
                        </tr>
                        <tr>
                            <td>UX Researcher</td>
                            <td>Digital Innovations</td>
                            <td>May 10, 2025</td>
                            <td><span class="status-badge rejected">Rejected</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="dashboard-widget">
            <div class="widget-header">
                <h3>Recommended Jobs</h3>
                <a href="<?= \yii\helpers\Url::to(['/jobs/recommended']) ?>" class="widget-view-all">View All</a>
            </div>
            <div class="widget-content">
                <div class="job-card">
                    <div class="job-company-logo">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="job-details">
                        <h4>Senior Web Developer</h4>
                        <p class="job-company">Tech Solutions Inc</p>
                        <p class="job-location"><i class="fas fa-map-marker-alt"></i> Remote</p>
                        <p class="job-salary"><i class="fas fa-dollar-sign"></i> $80,000 - $95,000</p>
                    </div>
                    <div class="job-action">
                        <a href="<?= \yii\helpers\Url::to(['/jobs/view', 'id' => 1]) ?>" class="btn btn-outline-primary">View Job</a>
                    </div>
                </div>
                <div class="job-card">
                    <div class="job-company-logo">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <div class="job-details">
                        <h4>UI/UX Designer</h4>
                        <p class="job-company">Creative Design Studio</p>
                        <p class="job-location"><i class="fas fa-map-marker-alt"></i> New York, NY</p>
                        <p class="job-salary"><i class="fas fa-dollar-sign"></i> $70,000 - $85,000</p>
                    </div>
                    <div class="job-action">
                        <a href="<?= \yii\helpers\Url::to(['/jobs/view', 'id' => 2]) ?>" class="btn btn-outline-primary">View Job</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>