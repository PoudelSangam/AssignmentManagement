$(document).ready(function() {
    $('#otpForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Collect OTP values
        const otp = $('#otp1').val() + $('#otp2').val() + $('#otp3').val() + $('#otp4').val();

        // AJAX request
        $.ajax({
            url: 'validate_otp.php', // URL to send the OTP to
            type: 'POST',
            data: { otp: otp },
            success: function(response) {
                // Handle different responses
                if (response === '101') {
                    
                     window.location.href = 'change_password.php';
                } else if (response === 'expired') {
                    alert('OTP has expired. Please request a new one.');
                } else if (response === 'invalid') {
                    alert('Invalid OTP. Please try again.');
                } else {
                    alert(response);
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    });
});

$(document).ready(function() {
    // Auto move to next input field
    $('.otp-input').on('input', function() {
        if (this.value.length === 1) {
            $(this).next('.otp-input').focus();
        }
    });

    // Prevent non-numeric input in OTP fields
    $('.otp-input').on('keydown', function(e) {
        if ((e.key < '0' || e.key > '9') && e.key !== 'Backspace') {
            e.preventDefault();
        }
    });

    // Automatically move to the previous field on Backspace
    $('.otp-input').on('keydown', function(e) {
        if (e.key === 'Backspace' && this.value.length === 0) {
            $(this).prev('.otp-input').focus();
        }
    });

    // 5-minute timer countdown
    let timeLeft = 300; // 300 seconds = 5 minutes
    const timerDisplay = $('#timer');
    
    function startTimer() {
        const timer = setInterval(function() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            
            // Add leading zero to seconds if less than 10
            seconds = seconds < 10 ? '0' + seconds : seconds;

            // Update the timer display
            timerDisplay.text(`Time remaining: ${minutes}:${seconds}`);
            
            if (timeLeft <= 0) {
                clearInterval(timer);
                timerDisplay.text('OTP expired');
                $('input').prop('disabled', true); // Disable the inputs when the time is up
            }

            timeLeft--;
        }, 1000);
    }

    startTimer();
});

