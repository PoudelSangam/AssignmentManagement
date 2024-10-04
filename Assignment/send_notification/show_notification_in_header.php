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
$sql = "SELECT notifications, time, status 
        FROM notification 
        WHERE intake = ? AND faculty = ? AND college = ? AND status = ? AND time >= ? 
        ORDER BY time DESC LIMIT 20";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sssss', $intake, $faculty, $college, $status, $oneWeekAgo);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];

while ($row = $result->fetch_assoc()) {
    $notifications[] = [
        'message' => $row['notifications'],
        'time' => $row['time'],
    ];
}

// Send as JSON response
header('Content-Type: application/json');
echo json_encode(['notifications' => $notifications]);

?>
