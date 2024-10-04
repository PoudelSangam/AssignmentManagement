<?php
include_once "../version.php";
session_start();
include_once "../header.php";

// Session variables
$semester = isset($_SESSION['semester']) ? $_SESSION['semester'] : '';  
$intakeYear = isset($_SESSION['intake_year']) ? $_SESSION['intake_year'] : '';  
$faculty = isset($_SESSION['faculty']) ? $_SESSION['faculty'] : '';  

// Load the subject data from JSON
$subjectData = file_get_contents('../admin/addassignment/subjectData.json');

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
  <title>Subject List</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    /* Scrollable container */
    #search-results {
      max-height: 635px; /* Adjust height as needed */
      overflow-y: auto;
      border: 1px solid #ccc;
      padding: 10px;
      background-color: white;
    }
    @layer utilities {
    .animate-ping {
        animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    @keyframes ping {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        100% {
            transform: scale(2);
            opacity: 0;
        }
    }
}
 @keyframes blink {
    0%, 20%, 80%, 100% {
      transform: scaleY(1); /* Normal eye */
    }
    40%, 60% {
      transform: scaleY(0.1); /* Blink (flattened) */
    }
  }

  /* Apply animation to the pupil */
  .pupil {
    transform-origin: center;
    animation: blink 4s infinite ease-in-out; /* Control the speed of the blink */
  }
  .percentage {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 1rem;
}
.spinner {
    position: relative;
}


    
  </style>
</head>
<body class="bg-gray-100">
     <main class="container mx-auto px-4 py-8">

  <div class="w-full">
    <!-- Search input and button -->
    <div class="max-w-lg mx-auto mb-4 flex items-center">
      <div class="inline-block flex flex-row w-full">
        <input type="text" class="border rounded-l-lg px-4 py-2 w-full" placeholder="Search Notes" id="search-input">
        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-r-lg focus:outline-none focus:shadow-outline" id="search-button">Search</button>
      </div>
      <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2" id="filter-button">Filter</button>
    </div>
        
    <div id="filter-options" class="hidden transition-transform duration-300 ease-in-out transform mb-4 max-w-lg w-full mx-auto">
      <div class="bg-white rounded-lg overflow-hidden shadow-lg p-4">
        <div class="flex flex-wrap items-center justify-between">
          <div class="mb-4">
            <label  class="block text-gray-700 font-bold mb-2">Select Subject:</label>
            <select id="subject" class="p-2 border rounded w-full">
              <option value="">Select Subject</option>
              <!-- Populated with subjects using JavaScript -->
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Scrollable Search results container -->
    <div id="search-results" class="grid grid-cols-1 gap-6 w-full">
      <!-- Search results will be loaded here -->
      <div id="error-message" class="text-red-500 mb-4"></div>
    </div>
  </div>
  </main>

  <script>
    const semester = <?php echo json_encode($semester); ?>;
    const intakeYear = <?php echo json_encode($intakeYear); ?>;
    const faculty = <?php echo json_encode($faculty); ?>;
    const curriculumType = <?php echo json_encode($curriculumType); ?>;
    const subjects = <?php echo json_encode($subjects); ?>;



    $(document).ready(function() {
      // Initially populate the subject dropdown

      // Show or hide filter options
      $('#filter-button').click(function() {
        $('#filter-options').toggleClass('hidden');
      });

      // Add your search/filter functionality here
      $('#apply-filters').click(function() {
        // Use the selected filter and display results
        const selectedSubject = $('#subject').val();
        console.log("Applying filter for subject:", selectedSubject);
        // Filter the search results based on the selected subject
      });
    });
  </script>

  <script src="script.js?v=<?php echo $version ?>"></script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>

</body>
</html>

<?php
include_once "../footer.php";
?>
