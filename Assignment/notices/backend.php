<?php
session_start();
include_once "../db.php";

// Assuming you have a database connection setup in $conn
$semester = $_SESSION['semester'];
$intake = $_SESSION['intake_year'];
$faculty = $_SESSION['faculty'];
$college = $_SESSION['college'];
$status = "unread";

// Check if session variables are set
if (!isset($_SESSION['semester'], $_SESSION['intake_year'], $_SESSION['faculty'], $_SESSION['college'])) {
    die(json_encode(["error" => "Required session variables are not set."]));
}

// Calculate the date one week ago
$oneWeekAgo = date('Y-m-d H:i:s', strtotime('-1 week'));

// Query to fetch notifications from the last week
$sql_notifications = "SELECT notifications AS message, time, status 
                      FROM notification 
                      WHERE intake = ? AND faculty = ? AND college = ? AND status = ? AND time >= ? 
                      ORDER BY time DESC LIMIT 10";

$stmt_notifications = $conn->prepare($sql_notifications);
$stmt_notifications->bind_param('sssss', $intake, $faculty, $college, $status, $oneWeekAgo);
$stmt_notifications->execute();
$result_notifications = $stmt_notifications->get_result();

$combined = [];
while ($row = $result_notifications->fetch_assoc()) {
    $combined[] = [
        'message' => $row['message'],
        'time' => $row['time'],
        'isNotification' => true
    ];
}

// Query to fetch notices from the notices table
$sql_notices = "SELECT title AS message, time FROM notice ORDER BY time DESC LIMIT 10";
$stmt_notices = $conn->prepare($sql_notices);
$stmt_notices->execute();
$result_notices = $stmt_notices->get_result();

while ($row = $result_notices->fetch_assoc()) {
    $combined[] = [
        'message' => $row['message'],
        'time' => $row['time'],
        'isNotification' => false
    ];
}

// Sort the combined array by time in descending order
usort($combined, function($a, $b) {
    return strtotime($b['time']) - strtotime($a['time']);
});

// Send combined data as JSON response
header('Content-Type: application/json');
echo json_encode([
    'notifications_and_notices' => $combined
]);
?>
