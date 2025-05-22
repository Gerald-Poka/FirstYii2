/**
 * Admin Navigation JavaScript - Job Application System
 * Handles the functionality for the admin navigation sidebar
 */
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const submenuItems = document.querySelectorAll('.admin-nav-item.has-submenu');
    const sidebar = document.getElementById('sidebar');
    
    // Toggle submenus
    function setupSubmenuToggle() {
        submenuItems.forEach(item => {
            const link = item.querySelector('.admin-nav-link');
            const submenu = item.querySelector('.admin-submenu');
            
            if (link && submenu) {
                // Set initial state (for items that should be open by default)
                if (item.classList.contains('active')) {
                    item.classList.add('open');
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                }
                
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Toggle current submenu
                    const isOpen = item.classList.contains('open');
                    
                    // Close all open submenus (regardless of current item state)
                    submenuItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('open')) {
                            otherItem.classList.remove('open');
                            const otherSubmenu = otherItem.querySelector('.admin-submenu');
                            if (otherSubmenu) {
                                otherSubmenu.style.maxHeight = null;
                            }
                        }
                    });
                    
                    // Toggle the clicked submenu
                    item.classList.toggle('open');
                    
                    // Animate the submenu height
                    if (item.classList.contains('open')) {
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    } else {
                        submenu.style.maxHeight = null;
                    }
                });
            }
        });
    }
    
    // Handle active state based on URL
    function setActiveItemBasedOnUrl() {
        const currentUrl = window.location.pathname;
        const navLinks = document.querySelectorAll('.admin-nav-link, .admin-submenu-link');
        
        navLinks.forEach(link => {
            const linkUrl = link.getAttribute('href');
            if (linkUrl && currentUrl.includes(linkUrl.split('?')[0])) {
                // Set active state for the link
                if (link.classList.contains('admin-submenu-link')) {
                    link.classList.add('active');
                    
                    // Find parent menu item and open it
                    const parentItem = link.closest('.admin-nav-item');
                    if (parentItem) {
                        parentItem.classList.add('active', 'open');
                        const submenu = parentItem.querySelector('.admin-submenu');
                        if (submenu) {
                            submenu.style.maxHeight = submenu.scrollHeight + 'px';
                        }
                    }
                } else {
                    link.parentElement.classList.add('active');
                }
            }
        });
    }
    
    // Badge counters - dynamic updates (simulate for demo)
    function setupBadgeCounters() {
        // This would normally be populated from server data
        // For demo, we'll just use the existing values
    }
    
    // Initialize
    setupSubmenuToggle();
    setActiveItemBasedOnUrl();
    setupBadgeCounters();
    
    // Expose API for other scripts to use if needed
    window.adminNavigation = {
        refresh: function() {
            setupSubmenuToggle();
            setActiveItemBasedOnUrl();
        }
    };
});