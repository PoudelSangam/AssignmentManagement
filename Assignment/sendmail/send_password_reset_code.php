<?php
// Autoload dependencies
require 'vendor/autoload.php';
include_once"../db.php";


use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendVerificationCode($gmail,$conn) {
    // Validate the email address
    // if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
    //     throw new Exception('Invalid email address.');
    // }

    // Generate a 4-digit numeric code
    $verificationCode = mt_rand(1000, 9999);
    
    $stmt = $conn->prepare("INSERT INTO opt (gmail, code) VALUES (?, ?)");
if ($stmt === false) {
    throw new Exception('Prepare statement failed: ' . $conn->error);
}

// Bind the parameters (gmail as string and verificationCode as integer)
$stmt->bind_param("si", $gmail, $verificationCode);

if (!$stmt->execute()) {
    throw new Exception('Could not store verification code in the database: ' . $stmt->error);
}
    

    // SMTP server configuration
    $mail = new PHPMailer(true);
    try {
        // SMTP server configuration
           $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST']; // Use environment variable
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME']; // Use environment variable
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set email sender and recipient
        $mail->setFrom('info@poudelsangam.com.np', 'Bit_Er');
        $mail->addAddress($gmail, 'Recipient');

        // Set email content
        $mail->isHTML(true);
        $mail->Subject = 'Verification Code';
        $mail->Body = 'Your verification code is: <b>' . $verificationCode . '</b>';

        // Send the email
        $mail->send();

        return $verificationCode;
    } catch (Exception $e) {
        // Handle errors
        throw new Exception('Mail could not be sent. Error: ' . $mail->ErrorInfo);
    }
}

?>
