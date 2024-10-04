<?php
session_start();
include_once 'db.php';


$semester = $_SESSION['semester'];
$intake_year = $_SESSION['intake_year'];
$faculty = $_SESSION['faculty'];
$college = $_SESSION['college'];

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve current page and calculate the offset
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 12;
$offset = ($page - 1) * $limit;

// Retrieve search parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';
$subject = isset($_GET['subject']) ? $_GET['subject'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Default SQL query for counting total records
$count_sql = "SELECT COUNT(*) AS total FROM assignmentlist WHERE semester = ? AND intake_year = ? AND faculty = ? AND college = ?";

// SQL query for fetching paginated records
$sql = "SELECT * FROM assignmentlist WHERE semester = ? AND intake_year = ? AND faculty = ? AND college = ?";

$count_types = 'ssss';
$count_params = [$semester, $intake_year, $faculty, $college];

$types = 'ssss';
$params = [$semester, $intake_year, $faculty, $college];

if (!empty($search) || !empty($subject) || !empty($status)) {
    $sql .= " AND 1=1";
    $count_sql .= " AND 1=1";
}

// Add conditions based on search parameters
if (!empty($search)) {
    $sql .= " AND (subject LIKE ? OR CAST(assignment_number AS CHAR) LIKE ?)";
    $count_sql .= " AND (subject LIKE ? OR CAST(assignment_number AS CHAR) LIKE ?)";
    $search_param = '%' . $search . '%';
    $types .= 'ss';
    $params[] = $search_param;
    $params[] = $search_param;
    $count_types .= 'ss';
    $count_params[] = $search_param;
    $count_params[] = $search_param;
}

if (!empty($subject)) {
    $sql .= " AND subject = ?";
    $count_sql .= " AND subject = ?";
    $types .= 's';
    $params[] = $subject;
    $count_types .= 's';
    $count_params[] = $subject;
}

if (!empty($status)) {
    if ($status == 'active') {
        $sql .= " AND `dead-line` >= CURDATE()";
        $count_sql .= " AND `dead-line` >= CURDATE()";
    } elseif ($status == 'completed') {
        $sql .= " AND `dead-line` < CURDATE()";
        $count_sql .= " AND `dead-line` < CURDATE()";
    } elseif ($status == 'pending') {
        $sql .= " AND `status` = 'pending'";
        $count_sql .= " AND `status` = 'pending'";
    }
}

// Add ordering by nearest deadline first and overdue deadlines last
$sql .= " ORDER BY 
            CASE 
                WHEN DATEDIFF(`dead-line`, CURDATE()) < 0 THEN 2  -- past deadlines
                WHEN DATEDIFF(`dead-line`, CURDATE()) > 0 THEN 1  -- future deadlines
                ELSE 0  -- today's deadlines
            END,
            ABS(DATEDIFF(`dead-line`, CURDATE()))";  

// Add LIMIT and OFFSET for pagination
$sql .= " LIMIT ? OFFSET ?";
$types .= 'ii';
$params[] = $limit;
$params[] = $offset;

// Prepare count statement to get total records
$count_stmt = $conn->prepare($count_sql);
if ($count_stmt) {
    $count_stmt->bind_param($count_types, ...$count_params);
    if ($count_stmt->execute()) {
        $count_result = $count_stmt->get_result();
        $row = $count_result->fetch_assoc();
        $total_records = $row['total'];
        $total_pages = ceil($total_records / $limit);
    }
    $count_stmt->close();
}

// Prepare and bind parameters for the main query
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        $assignments = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $assignments[] = $row;
            }
        }
    } else {
        echo '<p class="text-red-500">Failed to execute the SQL statement: ' . htmlspecialchars($stmt->error) . '</p>';
    }

    $stmt->close();
} else {
    echo '<p class="text-red-500">Failed to prepare the SQL statement: ' . htmlspecialchars($conn->error) . '</p>';
}

// HTML Rendering
if (empty($assignments)) {
    echo '<div id="noDataFoundAlert" class="text-center text-red-500">No Data Found</div>';
} else {
    echo '<div id="assignmentList" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">';
    foreach ($assignments as $assignment) {
        $deadlineDate = $assignment['dead-line'];
        $createdDate = $assignment['time'];

        $deadlineDateTime = new DateTime($deadlineDate);
        $createdDateTime = new DateTime($createdDate);
        $deadlineDateTime->modify('+1 day');

        $currentDateTime = new DateTime();
        $nepalTimeZone = new DateTimeZone('Asia/Kathmandu'); 
        $currentDateTime->setTimezone($nepalTimeZone);

        $interval = $currentDateTime->diff($deadlineDateTime);
        $remainingDays = $interval->days;

        if ($currentDateTime > $deadlineDateTime) {
            $remainingDays = -1;
        }

        $statusClass = 'bg-green-100';

        if ($remainingDays < 0) {
            $remainingDays = 'Closed';
            $statusClass = 'bg-red-100';
        } elseif ($remainingDays === 0) {
            $statusClass = 'bg-yellow-100';
            $remainingDays = 'Today';
        }

        $remainingDaysText = is_numeric($remainingDays) ? $remainingDays . ' day(s)' : $remainingDays;

        $isNew = false;
        $newInterval = $currentDateTime->diff($createdDateTime)->days;
        if ($newInterval <= 2) {
            $isNew = true;
        }

       echo '
    <div class="bg-white rounded-lg overflow-hidden shadow-lg mb-4 mx-auto w-5/6 ' . $statusClass . '">
        <div class="px-6 py-4 relative">
            <div class="font-bold text-xl mb-2">' . htmlspecialchars($assignment['subject']) . '</div>
            <p class="text-gray-700 text-base">Assignment ' . htmlspecialchars($assignment['assignment_number']) . '</p>
            <p class="text-gray-700 text-base">Deadline: ' . htmlspecialchars($assignment['dead-line']) . '</p>
            <p class="text-gray-700 text-base">Remaining Days: ' . $remainingDaysText . '</p>';
            
            if ($isNew) {
                echo '<div class="absolute top-0 right-0 mt-2 mr-2 bg-red-500 text-white py-1 px-3 rounded-full text-sm font-bold shadow-lg">
                        New
                      </div>';
            }

        echo '</div>
        <div class="px-6 py-4 text-center">
            <button class="primary hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    onclick="window.location.href=\'assignment_detail.php?id=' . $assignment['id'].'&_='.$assignment['id'] . '\'">
                View Assignment
            </button>
        </div>
    </div>';

    }
    echo '</div>';
}

// Pagination controls
echo '<div class="flex justify-center mt-4">';
echo '<nav class="inline-flex -space-x-px shadow-sm" aria-label="Pagination">';

$base_url = '?';
if (!empty($search)) $base_url .= 'search=' . urlencode($search) . '&';
if (!empty($subject)) $base_url .= 'subject=' . urlencode($subject) . '&';
if (!empty($status)) $base_url .= 'status=' . urlencode($status) . '&';

// Previous button
if ($page > 1) {
    echo '<a href="' . $base_url . 'page=' . ($page - 1) . '" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">Previous</a>';
}

// Page numbers
$start_page = max(1, $page - 1);
$end_page = min($total_pages, $page + 1);

for ($i = $start_page; $i <= $end_page; $i++) {
    if ($i == $page) {
        echo '<span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-gray-300">' . $i . '</span>';
    } else {
        echo '<a href="' . $base_url . 'page=' . $i . '" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50">' . $i . '</a>';
    }
}

// Next button
if ($page < $total_pages) {
    echo '<a href="' . $base_url . 'page=' . ($page + 1) . '" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">Next</a>';
}

echo '</nav>';
echo '</div>';

$conn->close();
?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>
