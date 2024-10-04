<?php
// Load .env file
require_once __DIR__ . '/../../environment/vendor/autoload.php';
use Dotenv\Dotenv;

// Initialize Dotenv to load .env file
$dotenv = Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->load();

// Example email to verify
$email = $_POST['Gmail'];

// Hunter.io API Key
$api_key = $_ENV['HUNTER_API_KEY'];  // Replace with your API key

// Hunter.io API URL
$api_url = "https://api.hunter.io/v2/email-verifier?email=$email&api_key=$api_key";

// cURL request to Hunter.io API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

// Decode the response
$response_data = json_decode($response, true);



?>
