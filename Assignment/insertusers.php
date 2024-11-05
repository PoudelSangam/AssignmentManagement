<?php
session_start();
include_once "db.php";
include_once "extract_details_from_email.php";
if (isset($_COOKIE['user'])) {
    // If not in session, but cookie is available, set session from cookie
    $_SESSION['user'] = json_decode($_COOKIE['user'], true);
}
$user = $_SESSION['user'];

// Assuming $user array contains the user data
$email = $user['email'];
$name = $user['name'];
$pic = $user['picture'];

// extract details from email
$detail=parseEmail($email);
$intake_year=$detail['intake_year'];
$faculty=$detail['faculty'];
$college=$detail['college'];

$_SESSION['semester']=$detail['semester'];
$_SESSION['intake_year']=$detail['intake_year'];
$_SESSION['faculty']=$detail['faculty'];
$_SESSION['college']=$detail['college'];

// Step 1: Check if the email already exists in the 'users' table
$checkEmailSql = $conn->prepare("SELECT email FROM users WHERE email = ?");
$checkEmailSql->bind_param("s", $email);
$checkEmailSql->execute();
$result = $checkEmailSql->get_result();

if ($result->num_rows > 0) {
    // Email already exists
    // echo "Error: The email $email is already registered.";
} else {
    // Email does not exist, insert new record
    $insertSql = $conn->prepare("INSERT INTO users (email, name, pic, intake_year, faculty, college) VALUES (?, ?, ?, ?, ?, ?)");
    $insertSql->bind_param("ssssss", $email, $name, $pic,$intake_year,$faculty,$college);

    if ($insertSql->execute()) {
        // echo "New user added successfully";
    } else {
        echo "Error: " . $insertSql->error;
    }

    $insertSql->close();
}

$checkEmailSql->close();
// $conn->close();
?>
