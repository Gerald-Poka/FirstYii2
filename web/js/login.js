$(document).ready(function() {
    // Password visibility toggle
    $('.toggle-password').click(function() {
        // Toggle icon
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        
        // Toggle password visibility
        var passwordField = $(this).siblings('.password-field');
        var type = passwordField.attr('type');
        
        if (type === 'password') {
            passwordField.attr('type', 'text');
            $(this).attr('title', 'Hide password');
        } else {
            passwordField.attr('type', 'password');
            $(this).attr('title', 'Show password');
        }
    });

    // Add focus animation
    $('.password-field').focus(function() {
        $(this).parent().addClass('input-focused');
    }).blur(function() {
        $(this).parent().removeClass('input-focused');
    });
});