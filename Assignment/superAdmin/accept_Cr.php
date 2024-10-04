<?php
include_once "../db.php";

// Check if the id is set in the URL and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the id

    // Prepare the SQL UPDATE statement
    $sql = "UPDATE cr SET status=? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameters to the statement
        $new_status = "active";
        $stmt->bind_param("si", $new_status, $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Check if any row was affected
            if ($stmt->affected_rows > 0) {
                header("Location: https://poudelsangam.com.np/Assignment/superAdmin/dashboard.php");
                exit(); // Ensure the script stops executing after redirection
            } else {
                echo "No assignment found with the given ID.";
            }
        } else {
            echo "Error updating assignment: " . $stmt->error;
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
