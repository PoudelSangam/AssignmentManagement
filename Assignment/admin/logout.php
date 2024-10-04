<?php
session_start();

unset($_SESSION['user']);
session_destroy();

// Prevent page caching
header('Cache-Control: no-cache, must-revalidate'); // HTTP 1.1
header('Pragma: no-cache'); // HTTP 1.0
header('Expires: 0'); // Proxies

header('Location: https://poudelsangam.com.np/Assignment/index.php');

?>
