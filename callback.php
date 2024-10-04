<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/environment/vendor/autoload.php';

use Dotenv\Dotenv; // Import Dotenv class

// Initialize Dotenv to load .env file
$dotenv = Dotenv::createImmutable(__DIR__ ); // Adjust the path to where .env is located
$dotenv->load();

$client = new Google_Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    
    if (isset($token['error'])) {
        echo 'Google OAuth error: ' . $token['error_description'];
        exit();
    }
    
    $client->setAccessToken($token['access_token']);

    $oauth2 = new Google_Service_Oauth2($client);
    $userInfo = $oauth2->userinfo->get();

    // Store user information in session
    $_SESSION['user'] = [
        'id' => $userInfo->getId(),
        'email' => $userInfo->getEmail(),
        'name' => $userInfo->getName(),
        'picture' => $userInfo->getPicture(),
        'locale' => $userInfo->getLocale(),
        'gender' => $userInfo->getGender(),
        'link' => $userInfo->getLink()
    ];
    // Store user information in a cookie
    $cookie_name = "user";
    $cookie_value = json_encode($_SESSION['user']); // Convert the session array to JSON string
    setcookie($cookie_name, $cookie_value, time()+(30 * 24 * 60 * 60)); // Cookie lasts 30 days

    // Redirect to the dashboard
    header('Location:Assignment/');
    exit();
} 
?>
