<?php
use yii\helpers\Html;
use yii\helpers\Url;

// Register footer-specific CSS
$this->registerCssFile(Yii::$app->request->baseUrl . '/css/web/footer.css');
?>

<footer id="main-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-info">
                    <div class="footer-logo">
                        <img src="<?= Yii::getAlias('@web/web/assets/logo.png') ?>" alt="Job Application System" 
                            class="img-fluid colored-logo" 
                            onerror="this.onerror=null; this.src='<?= Yii::getAlias('@web/images/default-logo.png') ?>';">
                    </div>
                    <p>The Job Application System connects talented professionals with outstanding career opportunities. We streamline the hiring process and help employers find the perfect candidates.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><i class="fas fa-chevron-right"></i> <a href="<?= Url::home() ?>">Home</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="<?= Url::to(['/site/about']) ?>">About Us</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="<?= Url::to(['/site/services']) ?>">Services</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="<?= Url::to(['/site/terms']) ?>">Terms of Service</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="<?= Url::to(['/site/privacy']) ?>">Privacy Policy</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>For Job Seekers</h4>
                    <ul>
                        <li><i class="fas fa-chevron-right"></i> <a href="<?= Url::to(['/jobs/browse']) ?>">Browse Jobs</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="<?= Url::to(['/profile/resume']) ?>">Create Resume</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="<?= Url::to(['/jobs/saved']) ?>">Saved Jobs</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="<?= Url::to(['/jobs/applications']) ?>">My Applications</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="<?= Url::to(['/jobs/alerts']) ?>">Job Alerts</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Contact Us</h4>
                    <p>
                        <i class="fas fa-map-marker-alt"></i> Dar es Salaam, Tanzania<br>
                        <i class="fab fa-whatsapp"></i> <a href="https://wa.me/255754318464">0754318464</a><br>
                        <i class="fas fa-envelope"></i> <a href="mailto:geraldndyamukama39@gmail.com">geraldndyamukama39@gmail.com</a><br>
                    </p>
                    
                    <div class="footer-newsletter">
                        <h4>Subscribe to our newsletter</h4>
                        <form action="<?= Url::to(['/site/newsletter']) ?>" method="post">
                            <input type="email" name="email" placeholder="Your email address" required>
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="copyright">
                        &copy; <?= date('Y') ?> <strong>Job Application System</strong>. All rights reserved.
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="credits">
                        Designed and developed by <a href="https://wa.me/255754318464"><strong>Gerald-Poka</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>