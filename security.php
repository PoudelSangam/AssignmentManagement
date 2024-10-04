<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/vendor/autoload.php'; // Path to Google Client library
require_once __DIR__ . '/environment/vendor/autoload.php';

use Dotenv\Dotenv; // Import Dotenv class

// Initialize Dotenv to load .env file
$dotenv = Dotenv::createImmutable(__DIR__ ); // Adjust the path to where .env is located
$dotenv->load();

use Google\Client as Google_Client; // Import Google Client class

$client = new Google_Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
$client->addScope('email');
$client->addScope('profile');

$authUrl = $client->createAuthUrl();

if (isset($_COOKIE['user'])) {
    header('Location: https://poudelsangam.com.np/Assignment/index.php');
    exit();
}
