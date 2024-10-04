<?php
include_once "../../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $deadline = $_POST['deadline'];
    $subject = $_POST['subject'];
    $assignment_question = $_POST['assignment_question'];
    $assignment_number = $_POST['assignment_number'];

    $sql = "UPDATE assignmentlist SET `dead-line` = ?, subject = ?, assignment_question = ?, assignment_number = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $deadline, $subject, $assignment_question, $assignment_number, $id);

    if ($stmt->execute()) {
        echo "Assignment updated successfully";
        // Redirect to index.php or show a success message
 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
