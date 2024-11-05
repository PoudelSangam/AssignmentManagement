<?php
session_start();

include_once "../../db.php";
include_once "../../extract_details_from_email.php";
include_once '../../send_notification/send_notification.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $assignment_question = $_POST['assignment_question'];

    // SQL query to select Gmail address based on session user ID
    $sql = "SELECT gmail FROM cr WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind the session user ID parameter
        $stmt->bind_param("i", $_SESSION['user_id']);

        // Execute the query
        $stmt->execute();

        // Store the result
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['gmail'];

            // Extract details from email
            $details = parseEmail($email);
            $intake_year = $details['intake_year'];
            $faculty = $details['faculty'];
            $college = $details['college'];
            $semester = $details['semester'];
            
            $title = "Notices";
         $body = strip_tags($assignment_question);
            $status = "unread"; // Example status
            $link="https://poudelsangam.com.np/Assignment/notices/";
           
            // Call sendNotifications for each faculty and intake year
            sendNotifications($conn, $intake_year, $faculty, $college, $title, $body, $link,$semester);

          
        } else {
            echo "Error: No user found with the given ID.";
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();

?>
