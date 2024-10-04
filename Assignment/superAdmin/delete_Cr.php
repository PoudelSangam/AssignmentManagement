<?php
include_once "../db.php";

// Check if the id is set in the URL and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the id

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM cr WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameter to the statement
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Check if any row was affected
            if ($stmt->affected_rows > 0) {
                header("Location: https://poudelsangam.com.np/Assignment/superAdmin/dashboard.php");
            } else {
                echo "No assignment found with the given ID.";
            }
        } else {
            echo "Error deleting assignment: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid ID.";
}

// Close the database connection
$conn->close();
?>
