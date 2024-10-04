<?php
include_once 'header.php';
include_once 'version.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Detail | Student Assignment Tracker</title>
    <meta name="description" content="View detailed information about specific assignments with our Student Assignment Tracker. Efficiently manage and track your academic tasks.">
    <meta name="keywords" content="pm tools, project management software, project planner, project tracking software, project tracking tools, task manager, todoist, deadline tracking web app, assignment tracking system, task management tool, student assignment tracker, project deadline management, task notification system, online task manager, deadline reminder app, task collaboration platform, project management for startups">
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom CSS for any additional styling (optional) -->
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <main class="w-5/6 mx-auto mt-8 flex-grow">
        <section class="assignment-detail">
            <div id="assignment-container" class="bg-gradient-to-r from-blue-50 to-blue-100 shadow-lg rounded-lg p-3 w-4/5 mx-auto border-2 border-gray-200 transition-transform transform hover:scale-105">
                <!-- Assignment details will be inserted here by JavaScript -->
            </div>
        </section>
    </main>
    <script src="./detail_scripts.js?re=<?php echo $version ?>"></script>
</body>
</html>
<?php
include_once 'footer.php';
?>
