// Slideshow functionality for the home page
document.addEventListener('DOMContentLoaded', function() {
    window.slides = Array.from(document.querySelectorAll('.slideshow-container .slide'));
    window.dots = Array.from(document.querySelectorAll('.slideshow-dots .dot'));

    let currentSlideIndex = 1;
    showSlide(currentSlideIndex);
    
    // Auto-advance slides every 5 seconds
    let slideInterval = setInterval(function() {
        changeSlide(1);
    }, 5000);
    
    // Expose functions to global scope for inline onclick handlers
    window.changeSlide = function(n) {
        showSlide(currentSlideIndex += n);
        // Reset the interval when manually changing slides
        clearInterval(slideInterval);
        slideInterval = setInterval(function() {
            changeSlide(1);
        }, 5000);
    };
    
    window.currentSlide = function(n) {
        showSlide(currentSlideIndex = n);
        // Reset the interval when manually changing slides
        clearInterval(slideInterval);
        slideInterval = setInterval(function() {
            changeSlide(1);
        }, 5000);
    };
    
    function showSlide(n) {
        if (slides.length === 0) return;

        let prevSlideIndex = currentSlideIndex - 1;
        // Reset index if out of bounds
        if (n > slides.length) {
            currentSlideIndex = 1;
        } else if (n < 1) {
            currentSlideIndex = slides.length;
        } else {
            currentSlideIndex = n;
        }

        // Remove all slide classes
        slides.forEach((slide, idx) => {
            slide.classList.remove('active', 'slide-left-out');
            slide.style.opacity = '0';
            slide.style.transform = 'translateX(100%)';
            slide.style.zIndex = '1';
        });

        // Animate previous slide out to left if moving forward
        if (prevSlideIndex !== currentSlideIndex - 1 && slides[prevSlideIndex]) {
            slides[prevSlideIndex].classList.add('slide-left-out');
        }

        // Show current slide
        const currentSlide = slides[currentSlideIndex - 1];
        currentSlide.classList.add('active');
        currentSlide.style.opacity = '1';
        currentSlide.style.transform = 'translateX(0)';
        currentSlide.style.zIndex = '2';

        // Update dots
        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentSlideIndex - 1].classList.add('active');

        announceSlide(currentSlideIndex);
    }
    
    // Handle saving jobs functionality
    const saveButtons = document.querySelectorAll('.save-job');
    if (saveButtons.length > 0) {
        saveButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const jobId = this.getAttribute('data-job-id');
                // You would replace this with an AJAX call to your backend
                console.log('Saving job ID:', jobId);
                
                // Visual feedback
                this.innerHTML = '<i class="fas fa-check"></i> Saved';
                this.classList.remove('btn-outline-secondary');
                this.classList.add('btn-success');
                this.disabled = true;
            });
        });
    }
    
    // Make sure we pause the slideshow when page is not visible
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            clearInterval(slideInterval);
        } else {
            slideInterval = setInterval(function() {
                changeSlide(1);
            }, 5000);
        }
    });
    
    // Add this before the closing });
    function announceSlide(index) {
        // Optional: Add screen reader announcement
        const liveRegion = document.getElementById('slideshow-live-region') || document.createElement('div');
        if (!liveRegion.id) {
            liveRegion.id = 'slideshow-live-region';
            liveRegion.setAttribute('aria-live', 'polite');
            liveRegion.className = 'sr-only';
            document.body.appendChild(liveRegion);
        }
        liveRegion.textContent = `Slide ${index} of ${slides.length}`;
    }
});