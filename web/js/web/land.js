// Enhanced mobile navigation handling - Fixed version
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing navigation...');
    
    // Header scroll effect
    const header = document.getElementById('main-header');
    
    if (header) {
        console.log('Header found, applying scroll effect');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    } else {
        console.warn('Header element not found');
    }
    
    // Mobile navigation toggle with improved UX
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (mobileNavToggle && navMenu) {
        console.log('Mobile toggle and menu found, setting up handlers');
        
        // Log initial state
        console.log('Initial menu state:', navMenu.classList.contains('active') ? 'active' : 'inactive');
        
        mobileNavToggle.addEventListener('click', function(e) {
            console.log('Toggle button clicked');
            e.preventDefault(); // Prevent any default action
            
            navMenu.classList.toggle('active');
            mobileNavToggle.classList.toggle('active');
            
            const isActive = navMenu.classList.contains('active');
            console.log('Menu toggled to:', isActive ? 'active' : 'inactive');
            
            // Toggle icon between bars and X
            const icon = mobileNavToggle.querySelector('i');
            if (icon) {
                if (isActive) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                    document.body.style.overflow = 'hidden';
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                    document.body.style.overflow = '';
                }
            }
        });
        
        // Handle dropdown toggles on mobile
        const dropdownItems = document.querySelectorAll('.nav-item.has-dropdown');
        dropdownItems.forEach(function(item, index) {
            item.style.setProperty('--item-order', index + 1);
            
            const link = item.querySelector('a');
            
            // Only apply click handler on mobile screens
            if (window.innerWidth < 992) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    item.classList.toggle('active');
                    
                    // Toggle the dropdown indicator rotation
                    const indicator = link.querySelector('.dropdown-indicator');
                    if (indicator) {
                        indicator.style.transform = item.classList.contains('active') 
                            ? 'rotate(180deg)' 
                            : 'rotate(0)';
                    }
                });
            }
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (navMenu.classList.contains('active') && 
                !navMenu.contains(e.target) && 
                !mobileNavToggle.contains(e.target)) {
                navMenu.classList.remove('active');
                mobileNavToggle.classList.remove('active');
                const icon = mobileNavToggle.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
                document.body.style.overflow = '';
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 991 && navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                mobileNavToggle.classList.remove('active');
                const icon = mobileNavToggle.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
                document.body.style.overflow = '';
            }
        });
        
        // Set animation orders
        const navItems = document.querySelectorAll('.nav-menu .nav-item');
        navItems.forEach(function(item, index) {
            item.style.setProperty('--item-order', index + 1);
        });
    } else {
        console.error('Mobile navigation elements not found:');
        console.log('Toggle button:', mobileNavToggle ? 'found' : 'not found');
        console.log('Nav menu:', navMenu ? 'found' : 'not found');
    }
    
    // Add smooth scrolling for all anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                // Adjust for fixed header height
                const headerHeight = document.getElementById('main-header').offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});
