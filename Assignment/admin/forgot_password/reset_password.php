<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start the session

// Include the database connection file
include_once "../../db.php";

// Check if the session contains the user's email
if (!isset($_SESSION['reset_password_gmail_id'])) {
    echo 'Session expired. Please try again.';
    exit;
}

$userEmail = $_SESSION['reset_password_gmail_id'];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the new password from the POST request
    $newPassword = $_POST['password'];

    // Perform server-side validation
    if (empty($newPassword)) {
        echo 'Password cannot be empty';
        exit;
    }

  

    // Hash the new password before saving it to the database
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Prepare the SQL query to update the user's password
    $stmt = $conn->prepare("UPDATE cr SET password = ? WHERE gmail = ?");

    // Check if the statement preparation was successful
    if ($stmt === false) {
        echo "Failed to prepare the SQL statement. Error: " . $conn->error;
        exit;
    }

    // Bind the hashed password and user email to the statement
    $stmt->bind_param("ss", $hashedPassword, $userEmail);

    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        // If successful, output 'success' (or redirect the user)
        echo 'success';
        // Optional: Redirect to a login page after password reset
        // header("Location: login.php");
        session_destroy();
        
        exit;
    } else {
        // If the statement execution fails, show an error message
        echo "Database error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
