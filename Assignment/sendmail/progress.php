<?php
// progress.php - This file will be used to provide real-time processing updates

// Start a session
session_start();

$totalSteps = 100;
for ($i = 0; $i <= $totalSteps; $i += 10) {
   // usleep(50000); // Simulate some processing time (adjust as needed)
    $progress = $i; // Store progress in session
}

// Output progress as JSON
header('Content-Type: application/json');
echo json_encode(['progress' => $progress]);
?>
