<?php
// Database connection
include_once "../../db.php";

// Define allowed file types and maximum file size (20 MB)
$allowedTypes = ['application/pdf'];
$maxFileSize = 50 * 1024 * 1024; // 20 MB in bytes

// Prepare the response array
$response = ['success' => false, 'message' => 'Unknown error'];

// Retrieve POST parameters
$faculty = $_POST['faculty'] ?? '';
$semester = $_POST['semester'] ?? '';
$batch = $_POST['batch'] ?? '';
$subject = $_POST['subject'] ?? '';
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';

// Handle file upload
if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['pdf']['tmp_name'];
    $fileName = time() . "_" . basename($_FILES['pdf']['name']);
    $fileSize = $_FILES['pdf']['size'];
    $fileType = $_FILES['pdf']['type'];

    // Validate file type
    if (!in_array($fileType, $allowedTypes)) {
        $response['message'] = 'Only PDF files are allowed.';
        echo json_encode($response);
        exit();
    }

    // Validate file size
    if ($fileSize > $maxFileSize) {
        $response['message'] = 'File size exceeds the maximum limit of 50 MB.';
        echo json_encode($response);
        exit();
    }

    // Define the server upload directory
    $uploadDir = "../../Notes/file/{$faculty}/{$semester}/{$subject}/";

    // Create the directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create directories recursively
    }

    // Define the file path
    $filePath = $uploadDir . $fileName;

    // Move the file to the server upload directory
    if (move_uploaded_file($fileTmpPath, $filePath)) {
        // Prepare SQL query
        $stmt = $conn->prepare("INSERT INTO note (semester, faculty, subject, title, pdf_name, description) VALUES (?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            // Bind parameters and execute
            $stmt->bind_param('ssssss', $semester, $faculty, $subject, $title, $fileName, $description);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response['success'] = true;
                $response['message'] = 'PDF uploaded and details saved successfully.';
            } else {
                $response['message'] = 'Failed to save details to the database.';
            }

            // Close the statement
            $stmt->close();
        } else {
            $response['message'] = 'Failed to prepare SQL statement.';
        }
    } else {
        $response['message'] = 'Failed to move uploaded file.';
    }
} else {
    $response['message'] = 'No file uploaded or upload error.';
}

// Close the connection
$conn->close();

// Output the response as JSON
echo json_encode($response);
?>
