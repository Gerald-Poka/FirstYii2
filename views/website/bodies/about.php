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
    <div id="about" class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="about-title">About Our Platform</h1>
                <div class="title-underline"></div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-lg-6">
            <div class="about-content">
                <h2>Our Mission</h2>
                <p>We're on a mission to transform how people find jobs and how companies hire talent. Our platform connects qualified candidates with their ideal employers through innovative technology and personalized career guidance.</p>
                
                <h2 class="mt-4">Our Story</h2>
                <p>Founded in 2020, our platform emerged from a simple idea: job searching shouldn't be frustrating. Our team of HR professionals and tech experts built a solution that makes career advancement accessible to everyone.</p>
                
                <div class="stats-container">
                <div class="stat-item me-2">
                    <div class="stat-number">10K+</div>
                    <div class="stat-label">Job Seekers</div>
                </div>
                <div class="stat-item mx-2">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Companies</div>
                </div>
                <div class="stat-item ms-2">
                    <div class="stat-number">85%</div>
                    <div class="stat-label">Success Rate</div>
                </div>
                </div>
            </div>
            </div>
            
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/web/slide3.jpg" alt="Our Team" class="img-fluid rounded">
                    <div class="image-shape"></div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="team-section">
                    <h2 class="text-center">Our Leadership Team</h2>
                    <div class="title-underline center"></div>
                    
                    <div class="row mt-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="team-member">
                                <div class="member-image">
                                    <img src="<?= Yii::$app->request->baseUrl ?>/images/web/slide4.jpg" alt="Team Member">
                                </div>
                                <h4>Sarah Johnson</h4>
                                <p class="member-role">Chief Executive Officer</p>
                                <p class="member-bio">15+ years of experience in HR and recruitment technology. Previously led talent acquisition at Fortune 500 companies.</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="team-member">
                                <div class="member-image">
                                    <img src="<?= Yii::$app->request->baseUrl ?>/images/web/slide4.jpg" alt="Team Member">
                                </div>
                                <h4>Michael Chen</h4>
                                <p class="member-role">Chief Technology Officer</p>
                                <p class="member-bio">Former tech lead at leading recruitment platforms. Expert in AI-based matching algorithms and talent assessment.</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="team-member">
                                <div class="member-image">
                                    <img src="<?= Yii::$app->request->baseUrl ?>/images/web/slide5.jpg" alt="Team Member">
                                </div>
                                <h4>Elena Rodriguez</h4>
                                <p class="member-role">Head of Customer Success</p>
                                <p class="member-bio">Dedicated to creating exceptional experiences for both job seekers and employers using our platform.</p>
                            </div>
                        </div>
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
