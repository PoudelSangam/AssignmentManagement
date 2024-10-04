<?php
session_start();

// If user information is not in session, redirect to login page
if (!isset($_SESSION['Admin_gmail'])) {
    header('Location: ../index.php');
    exit();
}
?>