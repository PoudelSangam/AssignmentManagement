<?php
session_start();

  $cookie_value = json_encode($_SESSION['user']);
   
    setcookie('user', '$cookie_value', time()-3600, '/'); // Expire the cookie immediately
unset($_COOKIE['user']);
unset($_SESSION['user']);
session_destroy();
header('Location: https://poudelsangam.com.np');
exit();
?>
