document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('assignmentForm');
    const submitButton = document.getElementById('submitButton');
    const loadingOverlay = document.getElementById('loadingOverlay');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Disable the submit button and show the loading overlay
        submitButton.disabled = true;
        loadingOverlay.classList.remove('hidden');

        const formData = new FormData(form);
        const assignmentQuestion = tinymce.get('mytextarea').getContent();
        formData.set('assignment_question', assignmentQuestion);

        // Make an AJAX request
        fetch('submit_notices.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Display the response message
            alert(data);

            // Optionally, reset the form
            form.reset();
            tinymce.get('mytextarea').setContent('');

            // Re-enable the submit button and hide the loading overlay
            submitButton.disabled = false;
            loadingOverlay.classList.add('hidden');
        })
        .catch(error => {
            console.error('Error:', error);

            // Re-enable the submit button and hide the loading overlay even if there's an error
            submitButton.disabled = false;
            loadingOverlay.classList.add('hidden');
        });
    });
});
