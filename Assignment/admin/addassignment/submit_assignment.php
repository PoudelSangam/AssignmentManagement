<?php
session_start();

include_once "../../db.php";
include_once "../../extract_details_from_email.php";
include_once '../../send_notification/send_notification.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deadline = $_POST['deadline'];
    $subject = $_POST['subject'];
    $assignment_question = $_POST['assignment_question'];
    $assignment_number = $_POST['assignment_number'];

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
            
            $title = "New Assignment";
            $body = "Assignment of {$subject} is added. Deadline is {$deadline}.";
            
            sendNotifications($conn, $intake_year, $faculty, $college, $title, $body);

            // Insert assignment details into the database
            $insert_sql = "INSERT INTO assignmentlist (`dead-line`, subject, assignment_question, assignment_number, intake_year, faculty, college, semester) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            if ($insert_stmt = $conn->prepare($insert_sql)) {
                $insert_stmt->bind_param('sssisssi', $deadline, $subject, $assignment_question, $assignment_number, $intake_year, $faculty, $college, $semester);

                if ($insert_stmt->execute()) {
                    echo "Assignment added succesfully";
                } else {
                    echo "Error: " . $insert_stmt->error;
                }
                $insert_stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
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
