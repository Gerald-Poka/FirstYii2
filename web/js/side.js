document.addEventListener("DOMContentLoaded", function() {
    // Sidebar toggle functionality
    const toggleBtn = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            
            // If main content exists, adjust it when sidebar is toggled
            if (mainContent) {
                mainContent.classList.toggle('expanded');
            }
            
            // Store sidebar state in localStorage
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebar-collapsed', isCollapsed);
        });
        
        // Apply saved sidebar state
        const savedState = localStorage.getItem('sidebar-collapsed');
        if (savedState === 'true') {
            sidebar.classList.add('collapsed');
            if (mainContent) {
                mainContent.classList.add('expanded');
            }
        }
    } else {
        console.log('Toggle button or sidebar not found');
    }
    
    // Submenu toggle functionality
    const submenuItems = document.querySelectorAll('.has-submenu');
    if (submenuItems.length > 0) {
        submenuItems.forEach(item => {
            const link = item.querySelector('.nav-link');
            if (link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    item.classList.toggle('open');
                    
                    // Close other open submenus
                    submenuItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('open')) {
                            otherItem.classList.remove('open');
                        }
                    });
                });
            }
        });
    }
    
    // Handle mobile navigation
    // const mobileToggle = document.querySelector('.mobile-nav-toggle');
    // const mobileNav = document.querySelector('.mobile-navigation');
    
    // if (mobileToggle && mobileNav) {
    //     mobileToggle.addEventListener('click', function() {
    //         mobileNav.classList.toggle('active');
    //         mobileToggle.classList.toggle('active');
    //     });
    // } else {
    //     const missingElements = [];
    //     if (!mobileToggle) {
    //         missingElements.push("the mobile toggle button (expected class '.mobile-nav-toggle')");
    //     }
    //     if (!mobileNav) {
    //         missingElements.push("the mobile navigation menu (expected class '.mobile-navigation')");
    //     }
        
    //     let alertMessage = "Mobile navigation setup error: ";
    //     if (missingElements.length > 0) {
    //         alertMessage += `Could not find ${missingElements.join(' and ')}. `;
    //     } else {
    //         // This case should ideally not be reached if the main `if` condition is `mobileToggle && mobileNav`
    //         // and the `else` means at least one is missing.
    //         // However, to be safe:
    //         alertMessage += "An unspecified mobile navigation element was not found. ";
    //     }
    //     alertMessage += "Please check the HTML structure. Mobile navigation may not work correctly.";
        
    //     alert(alertMessage);
    //     // It's also good practice to log this to the console for developers.
    //     console.warn(alertMessage);
    // }
    
    // Add a class to document body based on sidebar state
    function updateBodyClass() {
        if (sidebar) {
            if (sidebar.classList.contains('collapsed')) {
                document.body.classList.add('sidebar-collapsed');
            } else {
                document.body.classList.remove('sidebar-collapsed');
            }
        }
    }
    
    // Initial body class update
    updateBodyClass();
    
    // Update body class when sidebar state changes
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', updateBodyClass);
    }
});