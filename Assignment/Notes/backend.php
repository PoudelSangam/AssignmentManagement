<?php
// Include database connection file
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "../db.php";

// Retrieve POST parameters
$subjectName = isset($_POST['subject']) ? $_POST['subject'] : '';
$facultyName = isset($_POST['faculty']) ? $_POST['faculty'] : '';
$semesterName = isset($_POST['semester']) ? $_POST['semester'] : '';

// Initialize an empty response array
$response = [];

// Build the SQL query based on the presence of parameters
$sql = "SELECT id, semester, faculty, subject, title, pdf_name, description FROM note WHERE subject LIKE ?";
$params = ["%" . $subjectName . "%"]; 
$paramTypes = "s";

if (!empty($facultyName)) {
    $sql .= " AND faculty = ?";
    $params[] = $facultyName;
    $paramTypes .= "s";
}

if (!empty($semesterName)) {
    $sql .= " AND semester = ?";
    $params[] = $semesterName;
    $paramTypes .= "s";
}
$sql .= " LIMIT 16";

$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameters dynamically
    $stmt->bind_param($paramTypes, ...$params);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Fetch the data from the database
    while ($row = $result->fetch_assoc()) {
        $response[] = [
            'id' => $row['id'],
            'semester' => $row['semester'],
            'faculty' => $row['faculty'],
            'subject' => $row['subject'],
            'title' => $row['title'],
            'pdf_name' => $row['pdf_name'],
            'description' => $row['description']
        ];
    }

    // If no records found, set an error message
    if (empty($response)) {
        $response = ['error' => 'No data found. Try to enter full name of subject'];
    }

    // Close the statement
    $stmt->close();
} else {
    // Capture any SQL preparation errors
    $response = ['error' => 'Failed to prepare SQL statement.'];
}

// Close the connection
$conn->close();

// Return the result as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
