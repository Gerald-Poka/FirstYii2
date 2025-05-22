<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Job Application System';


// Include the header
echo $this->render('../main/header');

// Include the navigation below header
echo $this->render('../main/nav');
?>

 <div class="landing-wrapper">
    <div id="services" class="services-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="services-title">Our Premium Services</h1>
                    <p class="services-subtitle">Comprehensive solutions for job seekers and employers</p>
                    <div class="title-divider"></div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3>Resume Building</h3>
                        <p>Our AI-powered resume builder creates ATS-optimized resumes that highlight your skills and experience to help you stand out from the competition.</p>
                        <div class="service-features">
                            <div class="service-feature-item"><i class="fas fa-check"></i> Professional Templates</div>
                            <div class="service-feature-item"><i class="fas fa-check"></i> Keyword Optimization</div>
                            <div class="service-feature-item"><i class="fas fa-check"></i> Expert Review</div>
                        </div>
                        <a href="" class="btn-service">Learn More</a>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card featured">
                        <div class="popular-tag">Most Popular</div>
                        <div class="service-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3>Job Matching</h3>
                        <p>Our advanced algorithm matches your profile with thousands of job opportunities to find the perfect fit for your skills and career goals.</p>
                        <div class="service-features">
                            <div class="service-feature-item"><i class="fas fa-check"></i> AI-Powered Matching</div>
                            <div class="service-feature-item"><i class="fas fa-check"></i> Personalized Recommendations</div>
                            <div class="service-feature-item"><i class="fas fa-check"></i> Application Tracking</div>
                        </div>
                        <a href="<?= Url::to(['/services/job-matching']) ?>" class="btn-service">Learn More</a>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3>Career Coaching</h3>
                        <p>Work with experienced career coaches who provide personalized guidance to help you advance your career and achieve your professional goals.</p>
                        <div class="service-features">
                            <div class="service-feature-item"><i class="fas fa-check"></i> 1-on-1 Sessions</div>
                            <div class="service-feature-item"><i class="fas fa-check"></i> Interview Preparation</div>
                            <div class="service-feature-item"><i class="fas fa-check"></i> Career Path Planning</div>
                        </div>
                        <a href="" class="btn-service">Learn More</a>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3>Employer Solutions</h3>
                        <p>Streamline your recruitment process with our comprehensive employer services designed to help you find the best talent quickly and efficiently.</p>
                        <div class="service-features">
                            <div class="service-feature-item"><i class="fas fa-check"></i> Candidate Screening</div>
                            <div class="service-feature-item"><i class="fas fa-check"></i> Automated Shortlisting</div>
                            <div class="service-feature-item"><i class="fas fa-check"></i> Interview Management</div>
                        </div>
                        <a href="" class="btn-service">Learn More</a>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <h3>Interview Preparation</h3>
                        <p>Practice with our AI interview simulator and get real-time feedback to help you ace your next job interview and land your dream role.</p>
                        <div class="service-features">
                            <div class="service-feature-item"><i class="fas fa-check"></i> Mock Interviews</div>
                            <div class="service-feature-item"><i class="fas fa-check"></i> Performance Analytics</div>
                            <div class="service-feature-item"><i class="fas fa-check"></i> Feedback Sessions</div>
                        </div>
                        <a href="" class="btn-service">Learn More</a>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3>Skill Development</h3>
                        <p>Access our library of courses and workshops designed to help you develop in-demand skills that will advance your career and increase your marketability.</p>
                        <div class="service-features">
                            <div class="service-feature-item"><i class="fas fa-check"></i> Industry-Specific Training</div>
                            <div class="service-feature-item"><i class="fas fa-check"></i> Certification Programs</div>
                            <div class="service-feature-item"><i class="fas fa-check"></i> Skill Assessments</div>
                        </div>
                        <a href="" class="btn-service">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Floating Contact Button -->
    <div class="floating-contact-btn">
        <div class="pulse"></div>
        <i class="fas fa-comment-alt"></i>
    </div>
</div>
