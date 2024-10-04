<?php 
require_once __DIR__ . '/../environment/vendor/autoload.php';

use Dotenv\Dotenv;

// Initialize Dotenv to load .env file
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

// Database connection
$servername = $_ENV['DB_SERVER'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => "Connection failed: " . $conn->connect_error]);
    exit();
}
?>