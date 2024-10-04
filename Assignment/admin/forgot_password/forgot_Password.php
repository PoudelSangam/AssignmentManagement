<?php
// Database connection
include_once "../../db.php";
include_once "../../sendmail/send_password_reset_code.php";
session_start();

// Variables
$gmail = isset($_POST['email']) ? trim($_POST['email']) : '';
$phoneNumber = isset($_POST['phone']) ? trim($_POST['phone']) : '';

// Validate email and phone number
if (!filter_var($gmail, FILTER_VALIDATE_EMAIL) || empty($phoneNumber)) {
    echo "Invalid email or phone number.";
    exit;
}

try {
    // Prepare and bind the SQL statement
    $sql = "SELECT * FROM cr WHERE gmail = ? AND phonenumber = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Failed to prepare the SQL statement: ' . $conn->error);
    }

    $stmt->bind_param("ss", $gmail, $phoneNumber);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        sendVerificationCode($gmail, $conn);
        echo "101"; // Successfully sent verification code
        $_SESSION['reset_password_gmail_id']=$gmail;
    } else {
        echo "Gmail or phone number does not exist in the database.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    // Handle errors
    echo 'Error: ' . $e->getMessage();
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
    exit;
}
?>
