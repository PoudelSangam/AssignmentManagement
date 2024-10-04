<?php
session_start();

// If user information is not in session, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}
?>