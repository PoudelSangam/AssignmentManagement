<?php
include_once '../../db.php';

// Handling POST data from AJAX request
$data = json_decode(file_get_contents("php://input"), true);

// Extracting form data
$fullName = $data['fullName'];
$phoneNumber = $data['phoneNumber'];
$email = $data['email'];
$password = $data['password'];
$status = '000'; // Adjust as needed

// Validate email uniqueness
$sql_check_email = "SELECT * FROM cr WHERE gmail = ?";
$stmt_check_email = $conn->prepare($sql_check_email);
$stmt_check_email->bind_param("s", $email);
$stmt_check_email->execute();
$result = $stmt_check_email->get_result();

if ($result->num_rows > 0) {
    // Email already exists, send error response
   
   
    $response = ( 'Email already exists. Please use a different email.');
    echo $response;
  
} else {
    // Encrypt the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into database
    $sql_insert_user = "INSERT INTO cr (name, gmail, phonenumber, password, status) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert_user = $conn->prepare($sql_insert_user);
    $stmt_insert_user->bind_param("ssssi", $fullName, $email, $phoneNumber, $password_hash, $status);

    if ($stmt_insert_user->execute()) {
        // Return success response
     
     
        $response = ('User signed up successfully.');
        echo $response;
       
    } else {
        // Return error response
       
       
        $response =('Error inserting user data: ');
        echo $response;
        
    }

    // Close insert statement
    $stmt_insert_user->close();
}

// Close check email statement
$stmt_check_email->close();

// Close connection
$conn->close();
?>
