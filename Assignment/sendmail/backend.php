<?php
// Autoload dependencies
require 'vendor/autoload.php';

// Load .env file
require_once __DIR__ . '/../../environment/vendor/autoload.php';
use Dotenv\Dotenv;

// Initialize Dotenv to load .env file
$dotenv = Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->load();

include 'mailverify.php';  // Assuming this file contains $response_data

use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Retrieve and sanitize POST data
$code = isset($_POST['code']) ? htmlspecialchars($_POST['code']) : '';
$subject = isset($_POST['Subject']) ? htmlspecialchars($_POST['Subject']) : '';
$gmail = isset($_POST['Gmail']) ? filter_var($_POST['Gmail'], FILTER_VALIDATE_EMAIL) : '';

$response = [];

// Ensure all fields are valid
if (empty($subject) || empty($gmail)) {
    $response['status'] = 'error';
    $response['message'] = 'All fields are required and must be valid.';
    echo json_encode($response);
    exit;
}

// Verify the email using included mailverify.php
if ($response_data['data']['status'] == 'valid') {
    // Create PHPMailer instance
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
        $mail->setFrom('info@poudelsangam.com.np', 'Sangam Poudel');
        $mail->addAddress($gmail, 'Recipient');

        // Set email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = 'Thank you for using this service...';

        // Attach a PDF if code is provided
        if (!empty($code)) {
            // Create and configure Dompdf instance
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', false);  // Disable PHP for security reasons

            $dompdf = new Dompdf($options);

            // Create HTML content with embedded code in a readable format
            $html = <<<HTML
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        pre {
            white-space: pre-wrap; /* CSS3 */
            word-wrap: break-word; /* Internet Explorer */
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <pre>
        {$code}
    </pre>
</body>
</html>
HTML;

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $output = $dompdf->output();

            // Attach PDF to the email
            $mail->addStringAttachment($output, 'code.pdf', 'base64', 'application/pdf');
        }

        // Attach any uploaded files (not just images)
        if (!empty($_FILES['attachments']['tmp_name'][0])) {
            foreach ($_FILES['attachments']['tmp_name'] as $index => $tmpName) {
                if (is_uploaded_file($tmpName)) {
                    $fileName = $_FILES['attachments']['name'][$index];
                    $fileType = $_FILES['attachments']['type'][$index];
                    $fileContent = file_get_contents($tmpName);

                    // Attach the file with its MIME type
                    $mail->addStringAttachment($fileContent, $fileName, 'base64', $fileType);
                }
            }
        }

        // Send the email
        $mail->send();

        // Respond with success
        $response['status'] = 'success';
        $response['message'] = 'Email sent successfully';
    } catch (Exception $e) {
        // Respond with error message
        $response['status'] = 'error';
        $response['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Respond with validation error message
    $response['status'] = 'error';
    $response['message'] = "The email address $gmail is not valid";
}

// Output response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
