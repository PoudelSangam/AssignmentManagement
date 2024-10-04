<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once '../../db.php';
header('Content-Type: text/plain');


// Get POST data (make sure to sanitize input to prevent SQL injection)
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Prepare and bind
$stmt = $conn->prepare("SELECT id, password FROM cr WHERE gmail = ?");
if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

$stmt->bind_param("s", $email);
if ($stmt->execute() === false) {
    die('Execute failed: ' . $stmt->error);
}

// Store and fetch results
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashed_password)) {
        // Password is correct
        $_SESSION['user_id'] = $id;
        echo 'Login successful';
    } else {
        // Password is incorrect
        echo 'Invalid email or password';
    }
} else {
    // Email not found
    echo 'email not found';
}


$stmt->close();
$conn->close();
?>
