<?php
include_once '../db.php';
// save-subscription.php
session_start();

$data = file_get_contents('php://input');
$subscription = json_decode($data, true);

// Check if the 'user' cookie is set
if (!isset($_COOKIE['user'])) {
    echo 'User cookie is not set.';
    exit;
}

// Check if the session email is set
if (!isset($_SESSION['user'])) {
    echo 'Session email is not set.';
    exit;
}

$user = $_SESSION['user'];
$email = $user['email'];


// Update the user's subscription based on the session email
$stmt = $conn->prepare("
    UPDATE users 
    SET endpoint = ?, p256dh = ?, auth = ?
    WHERE email = ?
");
$stmt->bind_param(
    "ssss",
    $subscription['endpoint'],
    $subscription['keys']['p256dh'],
    $subscription['keys']['auth'],
    $email
);

if ($stmt->execute()) {
    echo 'Subscription updated in database.';

    // Update subscription in JSON file
    $subscriptionsFile = 'subscriptions.json';
    if (file_exists($subscriptionsFile)) {
        $subscriptions = json_decode(file_get_contents($subscriptionsFile), true);
        foreach ($subscriptions as &$existingSubscription) {
            if ($existingSubscription['endpoint'] === $subscription['endpoint']) {
                $existingSubscription['keys']['p256dh'] = $subscription['keys']['p256dh'];
                $existingSubscription['keys']['auth'] = $subscription['keys']['auth'];
                break;
            }
        }
        file_put_contents($subscriptionsFile, json_encode($subscriptions, JSON_PRETTY_PRINT));
        echo ' Subscription updated in JSON file.';
    }
} else {
    echo 'Error: ' . $stmt->error;
}

$stmt->close();
$conn->close();
?>
