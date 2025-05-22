document.addEventListener('DOMContentLoaded', function() {
    // Get the footer height
    const footer = document.getElementById('footer');
    const footerHeight = footer.offsetHeight;
    
    // Set appropriate bottom padding on main content
    const mainContent = document.querySelector('#main');
    mainContent.style.paddingBottom = (footerHeight + 20) + 'px';
    
    // Update padding if window is resized
    window.addEventListener('resize', function() {
        const updatedFooterHeight = footer.offsetHeight;
        mainContent.style.paddingBottom = (updatedFooterHeight + 20) + 'px';
    });
});