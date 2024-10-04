$(document).ready(function() {
    $('#resetForm').on('submit', function(event) {
        event.preventDefault(); // Prevent form from submitting the traditional way

        // Get the new and confirmed password
        const newPassword = $('#newPassword').val();
        const confirmPassword = $('#confirmPassword').val();

        // Validate the passwords
        if (newPassword === confirmPassword) {
            // Send the new password to the server via AJAX
            $.ajax({
                url: 'reset_password.php', // URL to your server-side password reset script
                type: 'POST',
                data: { password: newPassword },
                success: function(response) {
                    if (response === 'success') {
                        $('#message').text('Password successfully reset!').css('color', 'green');
                        window.location.href = '../index.php';
                    } else {
                        $('#message').text(response);
                    }
                },
                error: function(xhr, status, error) {
                    $('#message').text('An error occurred: ' + error);
                }
            });
        } else {
            $('#message').text('Passwords do not match!');
        }
    });
});
