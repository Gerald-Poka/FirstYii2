<?php
use yii\helpers\Html;
use yii\helpers\Url;

// Include the header
echo $this->render('../main/header');

// Include the navigation below header
echo $this->render('../main/nav');
?>

<div id="terms" class="terms-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="terms-title">Terms of Service</h1>
                <div class="terms-divider"></div>
                <p class="terms-updated">Last Updated: May 15, 2025</p>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-lg-3">
                <div class="terms-sidebar">
                    <div class="sidebar-heading">Contents</div>
                    <ul class="terms-navigation">
                        <li><a href="#introduction">1. Introduction</a></li>
                        <li><a href="#user-agreement">2. User Agreement</a></li>
                        <li><a href="#account">3. Account Registration</a></li>
                        <li><a href="#privacy">4. Privacy Policy</a></li>
                        <li><a href="#acceptable-use">5. Acceptable Use</a></li>
                        <li><a href="#intellectual-property">6. Intellectual Property</a></li>
                        <li><a href="#termination">7. Termination</a></li>
                        <li><a href="#disclaimer">8. Disclaimers</a></li>
                        <li><a href="#limitation">9. Limitation of Liability</a></li>
                        <li><a href="#changes">10. Changes to Terms</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="terms-content">
                    <section id="introduction" class="terms-section-content">
                        <h2>1. Introduction</h2>
                        <p>Welcome to our job application platform. These Terms of Service govern your use of our website, services, and applications. By accessing or using our platform, you agree to be bound by these Terms.</p>
                        <p>Please read these Terms carefully before using our services. If you do not agree with any part of these Terms, you may not access or use our platform.</p>
                    </section>
                    
                    <section id="user-agreement" class="terms-section-content">
                        <h2>2. User Agreement</h2>
                        <p>By creating an account or using our services, you agree to:</p>
                        <ul class="terms-list">
                            <li>Provide accurate and complete information</li>
                            <li>Maintain the security of your account</li>
                            <li>Accept responsibility for all activities that occur under your account</li>
                            <li>Comply with all applicable laws and regulations</li>
                        </ul>
                    </section>
                    
                    <section id="account" class="terms-section-content">
                        <h2>3. Account Registration</h2>
                        <p>To use certain features of our platform, you may need to register for an account. When you register, you agree to provide accurate information and keep your credentials secure. You are responsible for all activity under your account.</p>
                    </section>
                    
                    <section id="privacy" class="terms-section-content">
                        <h2>4. Privacy Policy</h2>
                        <p>Our <a href="<?= Url::to(['/site/privacy']) ?>" class="terms-link">Privacy Policy</a> describes how we collect, use, and protect your personal information. By using our platform, you consent to our collection and use of information as described in our Privacy Policy.</p>
                    </section>
                    
                    <section id="acceptable-use" class="terms-section-content">
                        <h2>5. Acceptable Use</h2>
                        <p>When using our platform, you agree not to:</p>
                        <ul class="terms-list">
                            <li>Violate any laws or regulations</li>
                            <li>Infringe on the rights of others</li>
                            <li>Submit false or misleading information</li>
                            <li>Distribute malware or harmful code</li>
                            <li>Interfere with the proper functioning of our platform</li>
                            <li>Attempt to gain unauthorized access to our systems</li>
                        </ul>
                    </section>
                    
                    <section id="intellectual-property" class="terms-section-content">
                        <h2>6. Intellectual Property</h2>
                        <p>Our platform and its content are protected by copyright, trademark, and other intellectual property laws. You may not use, reproduce, or distribute our content without our permission.</p>
                    </section>
                    
                    <section id="termination" class="terms-section-content">
                        <h2>7. Termination</h2>
                        <p>We reserve the right to suspend or terminate your account at our discretion, particularly if you violate these Terms. You may also terminate your account at any time.</p>
                    </section>
                    
                    <section id="disclaimer" class="terms-section-content">
                        <h2>8. Disclaimers</h2>
                        <p>Our platform is provided "as is" without warranties of any kind, either express or implied. We do not guarantee that our platform will be uninterrupted or error-free.</p>
                    </section>
                    
                    <section id="limitation" class="terms-section-content">
                        <h2>9. Limitation of Liability</h2>
                        <p>To the maximum extent permitted by law, we shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising out of or relating to your use of our platform.</p>
                    </section>
                    
                    <section id="changes" class="terms-section-content">
                        <h2>10. Changes to Terms</h2>
                        <p>We may modify these Terms at any time. We will notify you of any significant changes. Your continued use of our platform after such changes constitutes your acceptance of the new Terms.</p>
                    </section>
                    
                    <div class="terms-contact">
                        <h3>Contact Us</h3>
                        <p>If you have any questions about these Terms, please <a href="<?= Url::to(['/site/contact']) ?>" class="terms-link">contact us</a>.</p>
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