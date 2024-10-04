 document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('uploadForm').addEventListener('submit', async function (event) {
                event.preventDefault();

                // Select the submit button and result message elements
                const submitButton = document.getElementById('processing');
                const resultMessage = document.getElementById('resultMessage');

                // Check if the submit button exists
                if (!submitButton) {
                    console.error('Submit button not found.');
                    return;
                }

                // Change button text to "Loading..." and disable the button
                let loadingText = 'Loading';
                submitButton.textContent = loadingText;
                submitButton.disabled = true;

                // Animate the loading text
                const loadingAnimation = setInterval(() => {
                    if (submitButton.textContent.endsWith('...')) {
                        submitButton.textContent = loadingText;
                    } else {
                        submitButton.textContent += '.';
                    }
                }, 500);

                // Prepare form data
                const formData = new FormData(this);

                try {
                    // Send form data to the server
                    const response = await fetch('backend.php', {
                        method: 'POST',
                        body: formData
                    });

                    // Parse the response as JSON
                    const data = await response.json();

                    // Display the result message based on the server response
                    displayResultMessage(data.status, data.message);

                    // If the submission is successful, reset the form
                    if (data.status === 'success') {
                        this.reset();
                    } else {
                        displayResultMessage('error', data.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    displayResultMessage('error', 'An error occurred while processing your request.');
                } finally {
                    // Stop the loading animation
                    clearInterval(loadingAnimation);

                    // Reset button text and re-enable the submit button
                    submitButton.textContent = 'Submit';
                    submitButton.disabled = false;
                }
            });

            // Function to display the result message
            function displayResultMessage(status, message) {
                const resultMessage = document.getElementById('resultMessage');
                resultMessage.style.color = status === 'success' ? 'green' : 'red';
                resultMessage.textContent = message;
            }
        });