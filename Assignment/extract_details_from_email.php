<?php
include_once 'calculate_semester.php';
function parseEmail($email) {
    // Extract the part before '@' in the email
    
    
    $emailParts = explode('@', $email);
    $localPart = $emailParts[0];
    $domainPart = explode('.', $emailParts[1]);
    
    // Check if the domain part contains at least two sections
    if (count($domainPart) < 2) {
        return "Invalid email format.";
    }

    // Extract the college from the domain part
    $college = $domainPart[0];
    
    // showing the invalid email msg
if ($college != 'sagarmatha') {
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invalid Email</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h1 class="text-2xl font-bold mb-4">Invalid Email</h1>
           <p class="text-gray-700 mb-6">
  You can only view assignment details using your college email. However, you can still access notes and past questions by searching with the relevant subject or topic name.
</p>

            <a href="logout.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Return to Login Page
            </a>
        </div>
    </body>
    </html>
    ';
    die();
}


    
    // Split the local part into two sections based on '.'
    $parts = explode('.', $localPart);

    // Check if the local part contains exactly one section
    if (count($parts) != 2) {
        return "Invalid email format.";
    }

    // Extract the intake year and faculty
    $info = $parts[0];
    
    // The intake year is the first 3 characters
    $intakeYear = substr($info, 0, 3);

    // The faculty is the next 3 characters
    $faculty = substr($info, 3, 3);
    
    $currentSemester = calculateSemester('2' .$intakeYear);

    return [
        'intake_year' => $intakeYear,
        'faculty' => $faculty,
        'college' => $college,
        'semester'=>$currentSemester
    ];
}


?>
