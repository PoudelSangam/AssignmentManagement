<?php
include_once 'version.php';
include_once 'header.php';
include_once 'insertusers.php';
// include_once 'header.php';
//include_once 'scripts.php';
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
                        <label for="filter-subject" class="block text-gray-700 font-bold mb-2">Filter by Subject:</label>
                        <select class="border rounded-lg px-4 py-2" id="filter-subject">
                            <option value="0">Select Subject</option>
                            <option value="COA">COA</option>
                            <option value="Instrumentation">Instrumentation</option>
                            <option value="Probability">Probability</option>
                            <option value="Software">Software</option>
                            <option value="Data Communication">Data Communication</option>
                            <option value="Graphics">Graphics</option>
                            <option value="English">English</option>
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

<?php
include_once 'footer.php';
?>
 </div>
</body>
</html>
