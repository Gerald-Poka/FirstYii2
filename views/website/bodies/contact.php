<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

// Include the header
echo $this->render('../main/header');

// Include the navigation below header
echo $this->render('../main/nav');
?>

<div id="contact" class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="contact-title">Contact Us</h1>
                <div class="contact-divider"></div>
                <p class="contact-subtitle">We're here to help with any questions about our platform</p>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-lg-5">
                <div class="info-cards-container" data-aos="fade-up" data-aos-delay="100">
                    <!-- WhatsApp Card -->
                    <div class="contact-card">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="contact-text">
                                <h4>WhatsApp</h4>
                                <p><a href="https://wa.me/255754318464" target="_blank">0754 318 464</a></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Email Card -->
                    <div class="contact-card">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Email Us</h4>
                                <p><a href="mailto:geraldndyamukama39@gmail.com">geraldndyamukama39@gmail.com</a></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Location Card -->
                    <div class="contact-card">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Location</h4>
                                <p>Dar es Salaam, Tanzania</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Business Hours Card -->
                    <div class="contact-card">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="far fa-clock"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Business Hours</h4>
                                <p>Mon-Fri: 9am - 5pm</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="contact-social" data-aos="fade-up" data-aos-delay="200">
                    <h4>Connect With Us</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7">
                <div class="contact-form-card" data-aos="fade-left" data-aos-delay="200">
                    <h3>Send Us a Message</h3>
                    <?php $form = ActiveForm::begin(['id' => 'contact-form', 'options' => ['class' => 'contact-form']]); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" name="name" placeholder=" " required>
                                <label for="name" class="form-label">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder=" " required>
                                <label for="email" class="form-label">Your Email</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-floating">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder=" ">
                        <label for="subject" class="form-label">Subject</label>
                    </div>
                    
                    <div class="form-floating">
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder=" " required></textarea>
                        <label for="message" class="form-label">Your Message</label>
                    </div>
                    
                    <div class="form-submit">
                        <button type="submit" class="btn-submit">
                            Send Message <i class="fas fa-paper-plane ms-2"></i>
                        </button>
                    </div>
                    
                    <?php ActiveForm::end(); ?>
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