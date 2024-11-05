<?php
include_once 'version.php';
include_once 'header.php';
include_once 'insertusers.php';
 include_once 'check_subscribe_status.php';

// Session variables
$semester = isset($_SESSION['semester']) ? $_SESSION['semester'] : '';  
$intakeYear = isset($_SESSION['intake_year']) ? $_SESSION['intake_year'] : '';  
$faculty = isset($_SESSION['faculty']) ? $_SESSION['faculty'] : '';  

// Load the subject data from JSON
$subjectData = file_get_contents('./admin/addassignment/subjectData.json');

if ($subjectData === false) {
    die("Error: Unable to load subject data.");
}

$subjects = json_decode($subjectData, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error decoding JSON: " . json_last_error_msg());
}

$curriculumType = (intval($intakeYear) >= 80) ? 'new' : 'old';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Tracking System | Deadline Tracking Web App</title>
    <meta name="description" content="Track assignments efficiently with our deadline tracking web app. Manage tasks, track project deadlines, and collaborate using our assignment tracking system.">
    <meta name="keywords" content="pm tools, project management software, project planner, project tracking software, project tracking tools, task manager, todoist, deadline tracking web app, assignment tracking system, task management tool, student assignment tracker, project deadline management, task notification system, online task manager, deadline reminder app, task collaboration platform, project management for startups">
    <style>
        .primary {
            background: #3BEF80;
        }
    </style>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100">

    <main class="container mx-auto px-4 py-8">
        <div class="max-w-lg mx-auto mb-4 flex items-center">
            <div class="inline-block flex flex-row w-full">
                <input type="text" class="border rounded-l-lg px-4 py-2 w-full" placeholder="Search assignments" id="search-input">
                <button class="primary hover:bg-green-700 text-white font-bold py-2 px-4 rounded-r-lg focus:outline-none focus:shadow-outline" id="search-button">Search</button>
            </div>
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2" id="filter-button">Filter</button>
        </div>

        <div id="filter-options" class="hidden transition-transform duration-300 ease-in-out transform mb-4 max-w-lg w-full mx-auto">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg p-4">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Select Subject:</label>
                          <select id="filter-subject" class="p-2 border rounded w-full">
                            <option value="">Select Subject</option>
                            <!-- Populated with subjects using JavaScript -->
                          </select>
                    </div>
                    <div class="mb-4">
                        <label for="filter-status" class="block text-gray-700 font-bold mb-2">Filter by Assignment Status:</label>
                        <select class="border rounded-lg px-4 py-2" id="filter-status">
                            <option value="0">Select Status</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                        </select>
                         <button class="primary m-auto hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4 ml-5" id="apply-filters">Apply Filters</button>
                    </div>
                    <input type="hidden" name="page" id="page" value="<?php echo isset($_GET['page']) ? htmlspecialchars($_GET['page']) : '1'; ?>">
                   
                </div>
            </div>
        </div>
        
        
       

        <div id="assignmentList" class="my-10"></div>
        

       
    </main>

    <!-- JavaScript libraries -->
    <script src="js/fetch_assignment.js?v=<?php echo $version ?>"></script>
    <script src="js/subscription.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script>
        // Variables passed from PHP
        const semester = <?php echo json_encode($semester); ?>;
        const intakeYear = <?php echo json_encode($intakeYear); ?>;
        const faculty = <?php echo json_encode($faculty); ?>;
        const curriculumType = <?php echo json_encode($curriculumType); ?>;
        const subjects = <?php echo json_encode($subjects); ?>;

        // Function to populate the subjects dropdown based on the faculty and curriculum type
        function populateSubjects() {
            const subjectSelect = $('#filter-subject');
            const semesterNumber = "Semester " + semester;
            const subjectList = subjects[faculty]?.[curriculumType]?.[semesterNumber] || [];

            // Debugging logs
            console.log('Selected Faculty:', faculty);
            console.log('Curriculum Type:', curriculumType);
            console.log('Semester:', semesterNumber);
            console.log('Subjects:', subjectList);

            subjectSelect.empty(); // Clear existing options
            subjectSelect.append('<option value="">Select Subject</option>'); // Default option

            if (subjectList.length === 0) {
                subjectSelect.append('<option value="">No subjects available</option>');
                return;
            }

            // Populate options
            subjectList.forEach(subject => {
                subjectSelect.append(`<option value="${subject}">${subject}</option>`);
            });
        }

        // Call populateSubjects on document ready
        $(document).ready(function() {
            populateSubjects();
        });
    </script>

<?php
include_once 'footer.php';
?>
 </div>
</body>
</html>
