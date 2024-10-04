<?php
include_once '../db.php';
include_once 'header.php';

function isValidUrl($url) {
    $headers = @get_headers($url);
    return $headers && strpos($headers[0], '200');
} 
function check_subscribtion($end_point,$auth)
{
    if($end_point != null && $auth !=null)
    {
        return "Subscribe";
    }
    else
    {
        return "Not Subscribe";
    }
    

}

// Handle search functionality
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Pagination setup
$limit = 8; // Number of users per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

// Create base query
$query = "SELECT * FROM users";
if (!empty($search)) {
    $query .= " WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR faculty LIKE '%$search%' OR college LIKE '%$search%'";
}

// Get total number of users (for pagination)
$total_query = "SELECT COUNT(*) as total FROM (" . $query . ") as total_table";
$total_result = $conn->query($total_query);
$total_users = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_users / $limit);

// Append limit and offset to query
$query .= " LIMIT $start, $limit";

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User ID Cards</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <main class="content md:ml-64 transition-margin duration-500">
        <div class="container mx-auto max-w-lg md:max-w-2xl lg:max-w-7xl bg-gray-800 text-black p-6 rounded-lg shadow-md">

       <!-- Search form -->
<div class="bg-white rounded-lg shadow-md p-4 sm:p-6 mb-8">
    <form method="GET" action="">
        <div class="relative">
            <input type="text" name="search" placeholder="Search by name, email, faculty"
                   class="w-full p-3 sm:p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   value="<?php echo htmlspecialchars($search); ?>">
            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.41-1.41l5.24 5.25a1 1 0 01-1.42 1.42l-5.25-5.24zM8 14a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </form>
</div>





<!-- User ID Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $img_url = $row["pic"];
            if (!isValidUrl($img_url)) {
                $img_url = 'path/to/placeholder-image.jpg';  // Specify your placeholder image path
            }

            echo '
            <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 cursor-pointer" onclick="toggleCard(this)">
                <div class="flex items-center p-6 card-header">
                    <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-gray-300 mr-4">
                        <img class="w-full h-full object-cover" src="' . $img_url . '" alt="User Picture">
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-1">' . htmlspecialchars($row["name"]) . '</h2>
                    </div>
                </div>
                <div class="hidden card-details p-6">
                    <p class="text-sm text-gray-500 mb-2">' . htmlspecialchars($row["email"]) . '</p>
                    <p class="text-sm text-gray-700">Intake Year: ' . htmlspecialchars($row["intake_year"]) . '</p>
                    <p class="text-sm text-gray-700">Faculty: ' . htmlspecialchars($row["faculty"]) . '</p>
                    <p class="text-sm text-gray-700">College: ' . htmlspecialchars($row["college"]) . '</p>
                    <p class="text-sm text-gray-700">Status: ' . htmlspecialchars(check_subscribtion($row['endpoint'],$row['auth'])) . '</p>
                </div>
            </div>';
        }
    } else {
        echo "<p class='text-center text-gray-500 text-lg'>No users found.</p>";
    }
    ?>
</div>

<script>
function toggleCard(card) {
    const details = card.querySelector('.card-details');
    const header = card.querySelector('.card-header');

    // Toggle the visibility of the details
    details.classList.toggle('hidden');

    // Adjust the card size based on whether details are visible or not
    if (details.classList.contains('hidden')) {
        // Shrink card
        card.classList.remove('enlarged');
    } else {
        // Enlarge card
        card.classList.add('enlarged');
    }
}
</script>

<style>
/* CSS for enlarged card */
.enlarged {
    transform: scale(1.05);
}
</style>




            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>" 
                           class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            Previous
                        </a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"
                           class="relative inline-flex items-center px-4 py-2 border border-gray-300 <?php echo $i == $page ? 'bg-indigo-50 text-indigo-600' : 'bg-white text-gray-500'; ?> text-sm font-medium hover:bg-gray-50">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                    <?php if ($page < $total_pages): ?>
                        <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>"
                           class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            Next
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </main>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
