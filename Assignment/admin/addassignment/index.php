<?php
session_start();
include_once "../header.php";

// Session variables
$semester = isset($_SESSION['c_semester']) ? $_SESSION['c_semester'] : ' ';  // Example default for debugging
$intakeYear = isset($_SESSION['c_intake_year']) ? $_SESSION['c_intake_year'] : ' ';  // Example default for debugging
$faculty = isset($_SESSION['c_faculty']) ? $_SESSION['c_faculty'] : ' ';  // Example default for debugging

// Load the subject data from JSON
$subjectData = file_get_contents('subjectData.json');

// Check if file loading was successful
if ($subjectData === false) {
    die("Error: Unable to load subject data.");
}

$subjects = json_decode($subjectData, true);

// Check if JSON decoding was successful
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error decoding JSON: " . json_last_error_msg());
}

// Determine if the intake year is old or new curriculum
$curriculumType = (intval($intakeYear) >= 80) ? 'new' : 'old';

?>
<main class="content md:ml-64 transition-margin duration-500 flex flex-wrap">
    <div class="w-full p-4">
        <div class="container mx-auto max-w-7xl bg-gray-800 text-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Enter Assignment Details</h1>
            <form id="assignmentForm" method="post" class="space-y-4">
                <div class="flex flex-col lg:flex-row gap-4">
                    <div class="lg:w-2/3">
                        <div>
                            <label for="assignment_question" class="block text-sm font-medium mb-1">Assignment Question:</label>
                            <textarea id="mytextarea" rows="25" class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                    </div>

                    <div class="lg:w-1/3 space-y-4">
                        <div>
                            <label for="deadline" class="block text-sm font-medium mb-1">Deadline:</label>
                            <input type="date" id="deadline" name="deadline" required class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="assignment_number" class="block text-sm font-medium mb-1">Assignment Number:</label>
                            <input type="number" id="assignment_number" name="assignment_number" required class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium mb-1">Subject:</label>
                            <select id="subject" name="subject" required class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Subject</option>
                                <!-- Options will be dynamically populated by JavaScript -->
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" id="submitButton" class="w-full p-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<div id="loadingOverlay" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
    <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-16 w-16"></div>
</div>

<style>
    .loader {
        border-top-color: #3498db;
        animation: spin 1s infinite linear;
    }
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>

<script src="script.js"></script>
<script>
tinymce.init({
    selector: '#mytextarea',  // Selector for the textarea
    plugins: 'advlist autolink lists link image charmap print preview anchor ' + 
             'searchreplace visualblocks code fullscreen insertdatetime media ' +
             'table paste code help wordcount',
             
    // Display the menubar including File and Edit
    menubar: 'file edit view insert format tools table help', 

    // Customize the toolbar for small screens
    toolbar: 'undo redo | formatselect | bold italic backcolor | ' +
             'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',

    // Responsive settings
    mobile: {
        menubar: true,  // Show the menubar on mobile devices
        toolbar: 'undo redo | bold italic | link image',  // Compact toolbar for mobile
    },
    
   
    resize: true,  // Allow manual resizing
    setup: function (editor) {
        editor.on('init', function () {
            console.log('Editor initialized.');
        });
    }
});
</script>



<script>
    // Retrieve PHP variables using JSON encoding
    const semester = <?php echo json_encode($semester); ?>;  // e.g., "Semester 5"
    const intakeYear = <?php echo json_encode($intakeYear); ?>;  // e.g., "080"
    const faculty = <?php echo json_encode($faculty); ?>;  // e.g., "bct"
    const curriculumType = <?php echo json_encode($curriculumType); ?>;  // "old" or "new"

    // Subject data from JSON
    const subjects = <?php echo json_encode($subjects); ?>;

    // Debugging output
    // console.log("Semester:", semester);
    // console.log("Intake Year:", intakeYear);
    // console.log("Faculty:", faculty);
    // console.log("Curriculum Type:", curriculumType);
    // console.log("Subjects:", subjects);

    // Function to populate the subjects dropdown
    // function populateSubjects() {
        const subjectSelect = document.getElementById('subject');

        // Clear the select element
        subjectSelect.innerHTML = '<option value="">Select Subject</option>';

        // Split semester to get the number
        // const semesterParts = semester.split(" ");
        // const semesterNumber = (semesterParts.length > 1) ? semesterParts[1] : null;
         const semesterNumber = <?php echo json_encode("Semester " . $semester); ?>;


        // Debugging output
        console.log("Semester Number:", semesterNumber);

        // Get the subject list for the current faculty, curriculum, and semester
        const subjectList = subjects[faculty]?.[curriculumType]?.[semesterNumber] || [];

        // Debugging output
        console.log(`Faculty: ${faculty}, Curriculum Type: ${curriculumType}, Semester Number: ${semesterNumber}`);
        console.log("Subjects List:", subjectList);

        // Check if the subject list is valid and log error if not
        if (!subjectList || subjectList.length === 0) {
            console.error("No subjects found for the selected criteria.");
            // return;
        }

        // Populate the select dropdown with filtered subjects
        subjectList.forEach(subject => {
            const option = document.createElement('option');
            option.value = subject;
            option.textContent = subject;
            subjectSelect.appendChild(option);
        });
    // }

    // // Call populateSubjects function on page load
    //  populateSubjects();
</script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>