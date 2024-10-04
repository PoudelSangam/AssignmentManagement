document.addEventListener('DOMContentLoaded', () => {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('inputPassword');
    const signupForm = document.getElementById('signupForm'); // Add form reference

    togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle eye icon
        if (type === 'password') {
            togglePassword.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.93 7.07a9 9 0 0112.74 0M1 1l22 22" />
            </svg>`;
        } else {
            togglePassword.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.93 7.07a9 9 0 0112.74 0M1 1l22 22" />
            </svg>`;
        }
    });

    // Form submission handler
    signupForm.addEventListener('submit', (e) => {
        e.preventDefault(); // Prevent default form submission

        // Clear previous error messages
        clearErrors();

        // Get input values
        const fullName = document.getElementById('inputName').value.trim();
        const phoneNumber = document.getElementById('inputPhoneNumber').value.trim();
        const email = document.getElementById('inputEmail').value.trim();
        const password = document.getElementById('inputPassword').value.trim();

        let isValid = true;

        // Validate Full Name
        if (!fullName) {
            setError('inputNameError', 'Full name is required.');
            isValid = false;
        }

        // Validate Phone Number (10 digits)
        const phonePattern = /^\d{10}$/;
        if (!phonePattern.test(phoneNumber)) {
            setError('inputPhoneNumberError', 'Please enter a valid 10-digit phone number.');
            isValid = false;
        }

        // Validate Email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            setError('inputEmailError', 'Please enter a valid email address.');
            isValid = false;
        } else if (!email.endsWith('@sagarmatha.edu.np')) {
            setError('inputEmailError', 'Please enter your college email ending with @sagarmatha.edu.np.');
            isValid = false;
        }

        // Validate Password (minimum 6 characters)
        if (password.length < 6) {
            setError('inputPasswordError', 'Password must be at least 6 characters long.');
            isValid = false;
        }

        if (isValid) {
            // Prepare the data to be sent
            const formData = {
                fullName: fullName,
                phoneNumber: phoneNumber,
                email: email,
                password: password
            };

            // Send data using AJAX (fetch API)
            fetch('../admin/backgroundprocess/signup.php', { // Replace with your actual server URL
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
             .then(response => response.text())
            .then(responseText => {
                try {
                    
                        // Show success message
                        alert(responseText);
                         this.reset();
                    
                } catch (e) {
                    // Show success message
                    alert(responseText);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
           
          
        }
    });

    // Function to clear all error messages
    function clearErrors() {
        document.getElementById('inputNameError').innerText = '';
        document.getElementById('inputPhoneNumberError').innerText = '';
        document.getElementById('inputEmailError').innerText = '';
        document.getElementById('inputPasswordError').innerText = '';
    }

    // Function to set an error message for a specific field
    function setError(elementId, message) {
        document.getElementById(elementId).innerText = message;
    }
});
