<?php
use yii\helpers\Html;

// Register features-specific CSS
$this->registerCssFile(Yii::$app->request->baseUrl . '/css/web/features.css');
?>

<div id="features" class="landing-features">
    <div class="container">
        <h2 class="section-title">Premier Job Platform Features</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Smart Job Matching</h3>
                        <p>Our AI-powered algorithm connects you with opportunities that match your skills, experience, and career goals.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Professional Resume Builder</h3>
                        <p>Create ATS-optimized resumes with our industry-leading tools that increase interview chances by 65%.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Direct Employer Connections</h3>
                        <p>Build relationships with top companies through our verified employer network and application tracking system.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Career Growth Analytics</h3>
                        <p>Gain insights into industry trends, salary benchmarks, and personalized skill development recommendations.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Real-time Notifications</h3>
                        <p>Stay informed with instant alerts about new job openings, application status changes, and interview invitations.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Virtual Interview Prep</h3>
                        <p>Practice with our AI interview simulator and receive feedback to perform at your best when it matters most.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>