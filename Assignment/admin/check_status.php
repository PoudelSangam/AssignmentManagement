<?php
include_once "../db.php";
include_once "../extract_details_from_email.php";
session_start();
$id = $_SESSION['user_id'];

// Prepare and bind
$stmt = $conn->prepare("SELECT status, gmail FROM cr WHERE id = ?");
if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

$stmt->bind_param("i", $id);
if ($stmt->execute() === false) {
    die('Execute failed: ' . $stmt->error);
}

// Store and fetch results
$stmt->store_result();
$stmt->bind_result($status, $gmail);

if ($stmt->fetch()) {
    if ($status !== 'active') {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>dashboard</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <p class="text-gray-700 mb-6">Wait until the admin verifies you...</p>
            </div>
        </body>
        </html>
        ';
        die();
    } else {
        $detail = parseEmail($gmail);

        $_SESSION['c_semester'] = $detail['semester'];
        $_SESSION['c_intake_year'] = $detail['intake_year'];
        $_SESSION['c_faculty'] = $detail['faculty'];
        $_SESSION['c_college'] = $detail['college'];
    }
} else {
    // Handle case where no results are found
    die('No user found with the given ID.');
}

$stmt->close();
?>
