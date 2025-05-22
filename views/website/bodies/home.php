<?php
use yii\helpers\Html;
use yii\helpers\Url;

// Register slideshow-specific CSS and JS
$this->registerCssFile(Yii::$app->request->baseUrl . '/css/web/slideshow.css');
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/web/slideshow.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div class="job-application-slideshow">
    <div class="slideshow-container">
        <!-- Slide 1: Main Introduction - Interview/Meeting Scene -->
        <div class="slide enhanced-slide" id="slide-intro">
            <div class="slide-overlay"></div>
            <div class="slide-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <h1 class="slide-title animated fadeInDown">Find Your <span class="accent-text">Dream Job</span> Today</h1>
                            <p class="slide-description animated fadeInUp">
                                Connect with top employers and discover career opportunities that match your skills and aspirations in our premium job marketplace.
                            </p>
                            <div class="slide-actions animated fadeInUp">
                                <?= Html::a('<i class="fas fa-search"></i> <span class="text-white">Search Jobs</span>', ['/jobs/browse'], ['class' => 'btn btn-primary btn-lg']) ?>
                                <?= Html::a('<i class="fas fa-user-plus"></i> Join Now', ['/site/register'], ['class' => 'btn btn-outline-light btn-lg ml-2']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide 2: For Job Seekers - Application Form -->
        <div class="slide enhanced-slide" id="slide-jobseekers">
            <div class="slide-overlay"></div>
            <div class="slide-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 ml-auto">
                            <h1 class="slide-title animated fadeInDown">Craft Your <span class="accent-text">Professional Resume</span></h1>
                            <p class="slide-description animated fadeInUp">
                                Create an impressive resume with our easy-to-use builder and increase your chances of landing interviews with top companies.
                            </p>
                            <div class="slide-feature-list animated fadeInUp">
                                <div class="feature-item"><i class="fas fa-check-circle"></i> AI-powered resume templates</div>
                                <div class="feature-item"><i class="fas fa-check-circle"></i> Skills assessment & recommendations</div>
                                <div class="feature-item"><i class="fas fa-check-circle"></i> ATS-friendly formatting</div>
                            </div>
                            <div class="slide-actions mt-4 animated fadeInUp">
                                <?= Html::a('<i class="fas fa-file-alt"></i> <span class="text-white">Build My Resume</span>', ['/profile/resume'], ['class' => 'btn btn-primary btn-lg']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide 3: For Employers - Handshake -->
        <div class="slide enhanced-slide" id="slide-employers">
            <div class="slide-overlay"></div>
            <div class="slide-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <h1 class="slide-title animated fadeInDown">Find <span class="accent-text">Top Talent</span> For Your Company</h1>
                            <p class="slide-description animated fadeInUp">
                                Post jobs, review applications, and connect with qualified candidates all in one streamlined platform.
                            </p>
                            <div class="slide-feature-list animated fadeInUp">
                                <div class="feature-item"><i class="fas fa-check-circle"></i> Targeted job posting & promotion</div>
                                <div class="feature-item"><i class="fas fa-check-circle"></i> AI candidate matching & screening</div>
                                <div class="feature-item"><i class="fas fa-check-circle"></i> Comprehensive applicant tracking</div>
                            </div>
                            <div class="slide-actions mt-4 animated fadeInUp">
                                <?= Html::a('<i class="fas fa-plus-circle"></i> <span class="text-white">Post a Job</span>', ['/employer/post-job'], ['class' => 'btn btn-primary btn-lg']) ?>
                                <?= Html::a('<i class="fas fa-sign-in-alt"></i> Employer Login', ['/site/login', 'type' => 'employer'], ['class' => 'btn btn-outline-light btn-lg ml-2']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide Navigation Arrows -->
        <button class="prev" onclick="changeSlide(-1)" aria-label="Previous slide"><i class="fas fa-chevron-left"></i></button>
        <button class="next" onclick="changeSlide(1)" aria-label="Next slide"><i class="fas fa-chevron-right"></i></button>
    </div>
    
    <!-- Slide Indicators -->
    <div class="slideshow-dots">
        <span class="dot active" onclick="currentSlide(1)" aria-label="Slide 1"></span>
        <span class="dot" onclick="currentSlide(2)" aria-label="Slide 2"></span>
        <span class="dot" onclick="currentSlide(3)" aria-label="Slide 3"></span>
    </div>
</div>
