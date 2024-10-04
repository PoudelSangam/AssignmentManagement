document.addEventListener("DOMContentLoaded", function() {
    
  const form = document.getElementById('editAssignmentForm');

   

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        const formData = new FormData(form);
                const assignmentQuestion = tinymce.get('mytextarea').getContent();
                formData.set('assignment_question', assignmentQuestion);

        // Make an AJAX request
        fetch('submit_assignment.php', {
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
        })
        .catch(error => console.error('Error:', error));
    });
});
