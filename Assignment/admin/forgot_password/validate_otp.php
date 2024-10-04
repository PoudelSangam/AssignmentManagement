<?php
// Set the desired time zone (adjust accordingly)
date_default_timezone_set('Asia/Kathmandu');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start session if needed

// Include database connection parameters
include_once "../../db.php"; // Make sure this path is correct

// Retrieve the OTP code from POST data
$otp = $_POST['otp'] ?? '';

if ($otp) {
    try {
        // Get the current time
        $currentTime = new DateTime();

        // Prepare and execute the query to select OTP using MySQLi
        $stmt = $conn->prepare("SELECT * FROM opt WHERE code = ?");
        $stmt->bind_param("s", $otp); // "s" indicates the parameter is a string
        $stmt->execute();
        $result = $stmt->get_result();
        $otpRecord = $result->fetch_assoc();

        // Check if OTP exists in the database
        if ($otpRecord) {
            // Parse the OTP creation time from the database
            $otpCreationTime = DateTime::createFromFormat('Y-m-d H:i:s', $otpRecord['time']);
            if (!$otpCreationTime) {
                // Debugging: If DateTime creation fails
                echo 'Error parsing OTP creation time.<br>';
                exit;
            }

            // Calculate the difference between the current time and the OTP creation time
            $interval = $currentTime->diff($otpCreationTime);

            // Debugging: Display both current time and OTP creation time
            // echo 'Current time: ' . $currentTime->format('Y-m-d H:i:s') . '<br>';
            // echo 'OTP creation time: ' . $otpCreationTime->format('Y-m-d H:i:s') . '<br>';

            // Check if the OTP is valid within the 5-minute window
            if ($interval->i < 5 && $interval->h == 0 && $interval->days == 0) {
                // OTP is valid and within the 5-minute window
                echo '101'; // Success code for valid OTP
            } else {
                // OTP is expired
                echo 'expired';
            }
        } else {
            // OTP not found in the database
            echo 'invalid_otp';
        }

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        // Handle general errors
        error_log('Error: ' . $e->getMessage());
        echo 'error';
    }
} else {
    // No OTP provided
    echo 'no_otp';
}

// Close the database connection
$conn->close();
?>
