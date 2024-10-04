<?php
include_once "../version.php";
session_start();
include_once "../header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice Board</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body class="bg-gray-100">
      <h2 class="text-xl font-bold mb-2 text-center bg-blue-100 text-blue-600 p-2 rounded-lg shadow-md">
    Notice
</h2>
    <main class="container mx-auto px-0 py-0">
        

        <!-- Combined Notices and Notifications in Card Layout -->
        <div class="container mx-auto p-5">
    <div class="space-y-2 overflow-y-auto max-h-screen" style="scrollbar-width: none; -ms-overflow-style: none; overflow-y: scroll;">
        <div id="combined-card-container" class="grid grid-cols-1 gap-1 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Cards will be dynamically added here -->
        </div>
    </div>
</div>

    </main>

   <script>
    $(document).ready(function() {
        // Fetch the combined data from the backend
        $.getJSON('backend.php', function(data) {
            let cardContainer = $('#combined-card-container');
            
            // Append notices and notifications to the card container
            $.each(data.notifications_and_notices, function(index, item) {
               
                
                cardContainer.append(`
    <div class="bg-white shadow-md rounded-lg p-6 mb-4">
        <p class="text-gray-700 mb-4">${item.message}</p>
        <p class="text-sm text-gray-500">Posted on: ${item.time}</p>
    </div>
`);

            });
        });
    });
</script>

</body>
</html>

<?php
include_once "../footer.php";
?>
