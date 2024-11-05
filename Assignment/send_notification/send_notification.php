<?php
require __DIR__ . '/vendor/autoload.php';

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

require_once __DIR__ . '/../../environment/vendor/autoload.php';

use Dotenv\Dotenv;

// Initialize Dotenv to load .env file
$dotenv = Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->load();

function sendNotifications($conn, $intake_year, $faculty, $college, $title, $body,$link="https://poudelsangam.com.np/",$semester = "5") {
    $status = "unread";
    // Insert notification into the database
    $sql = "INSERT INTO notification (notifications, status, intake, faculty, semester, college) 
            VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssss", $body, $status, $intake_year, $faculty, $semester, $college);
        if (mysqli_stmt_execute($stmt)) {
            echo "New notification inserted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // VAPID keys from environment variables
    $publicKey = $_ENV['VAPID_PUBLIC_KEY'];
    $privateKey = $_ENV['VAPID_PRIVATE_KEY'];
    
    $stmt = $conn->prepare("SELECT endpoint, p256dh, auth FROM users WHERE intake_year = ? AND faculty = ? AND college = ?");
    
    if($intake_year == '0' && $faculty=='0' && $college=='0')
    {
       $stmt = $conn->prepare("SELECT endpoint, p256dh, auth FROM users "); 
        if (!$stmt) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    }

   else
   {
    if (!$stmt) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt->bind_param("sss", $intake_year, $faculty, $college);
    $stmt->execute();
    $result = $stmt->get_result();
   }

    if ($result === false) {
        die('Error retrieving subscriptions: ' . $conn->error);
    }

    echo "Debug: Number of subscriptions found: " . $result->num_rows . "<br>";

    if ($result->num_rows === 0) {
        die('No subscriptions found in the database.');
    }

    $auth = [
        'VAPID' => [
            'subject' => 'mailto:s9800938405@gmail.com',
            'publicKey' => $publicKey,
            'privateKey' => $privateKey,
        ],
    ];
    $webPush = new WebPush($auth);

    $payload = json_encode([
        'title' => $title,
        'body' => $body,
        'icon' => '../../download.png',
        'badge' => '../../download.png',
        'link' => $link 
    ]);

    if ($payload === false) {
        die('Failed to encode notification payload.');
    }

    while ($row = $result->fetch_assoc()) {
        if (empty($row['endpoint']) || empty($row['auth'])) {
            continue;
        }

        try {
            $subscription = Subscription::create([
                'endpoint' => $row['endpoint'],
                'publicKey' => $row['p256dh'],
                'authToken' => $row['auth'],
            ]);

            $report = $webPush->sendOneNotification($subscription, $payload);

            if ($report->isSuccess()) {
                echo 'Notification sent successfully';
            } else {
                $errorMessage = 'Notification failed to ' . $row['endpoint'] . ': ' . $report->getReason();
                error_log($errorMessage, 3, 'error.log');
                echo $errorMessage . '<br>';
            }
        } catch (Exception $e) {
            $exceptionMessage = 'Exception while sending notification to ' . $row['endpoint'] . ': ' . $e->getMessage();
            error_log($exceptionMessage, 3, 'error.log');
            echo $exceptionMessage . '<br>';
        }
    }

    // $stmt->close();
}
?>
