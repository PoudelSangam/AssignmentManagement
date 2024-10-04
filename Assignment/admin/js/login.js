$(document).ready(function() {
    $('form').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting the default way

        var email = $('#inputEmail').val();
        var password = $('#inputPassword').val();

        $.ajax({
            type: 'POST',
            url: '../admin/backgroundprocess/login.php',
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                if (response.includes('Login successful')) {
                    // Redirect to a new page or show a success message
                    window.location.href = '../admin/dashboard.php'; // Replace with your dashboard or home page
                } else {
                   // Show an error message
            $('#error-message').text(response).show();
            // Hide the error message after 5 seconds
            setTimeout(function() {
                $('#error-message').hide();
            }, 5000); // 5000 milliseconds = 5 seconds
                }
            },
            error: function(error) {
                // Handle errors
                $('#error-message').text('An error occurred. Please try again.').show();
            }
        });
    });
});

$(document).ready(function() {
    // Show the Forgot Password Modal
    $('#forgot-password-link').click(function(e) {
        e.preventDefault();
        $('#forgot-password-modal').removeClass('hidden');
    });

    // Close the Modal
    $('#cancel-modal').click(function() {
        $('#forgot-password-modal').addClass('hidden');
        $('#forgot-password-form').show(); // Show the form again
        $('#loading-spinner').addClass('hidden'); // Ensure the loader is hidden
    });

    // Handle the Submit Action
    $('#submit-modal').click(function() {
        var email = $('#forgot-email').val();
        var phone = $('#forgot-phone').val();

        // Hide form fields and show loading spinner
        $('#forgot-password-form').hide();
        $('#loading-spinner').removeClass('hidden');

        // AJAX call to handle the password reset
        $.ajax({
            url: '../admin/forgot_password/forgot_Password.php',
            method: 'POST',
            data: { email: email, phone: phone },
            success: function(response) {
                // Hide the loading spinner
                $('#loading-spinner').addClass('hidden');

                if (response.includes('101')) {
                    // Redirect to a new page or show a success message
                    window.location.href = '../admin/forgot_password/index.php'; // Replace with your dashboard or home page
                } else {
                    // Show the form again in case of error
                    $('#forgot-password-form').show();
                    // Show an error message
                    $('#reset-error-message').text(response).show();

                    // Hide the error message after 5 seconds
                    setTimeout(function() {
                        $('#reset-error-message').hide();
                    }, 5000); // 5000 milliseconds = 5 seconds
                }
            },
            error: function(error) {
                // Hide the loading spinner
                $('#loading-spinner').addClass('hidden');
                // Show the form again in case of error
                $('#forgot-password-form').show();

                // Handle errors
                $('#reset-error-message').text('An error occurred. Please try again.').show();
            }
        });
    });
});
