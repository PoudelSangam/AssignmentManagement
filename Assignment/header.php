<?php
// Start the session
session_start();
include_once "db.php";
// Check if user information is available in session or cookie
if (isset($_COOKIE['user'])) {
    // If not in session, but cookie is available, set session from cookie
    $_SESSION['user'] = json_decode($_COOKIE['user'], true);
}

// If user information is not in session, redirect to login page
if (!isset($_SESSION['user'])) {
    header('Location: ../');
    exit();
}

// Store user information from session
$user = $_SESSION['user'];

function login_to_admin($user) {
    // List of admin emails
    $admin_emails = [
        '078bct031.sangam@sagarmatha.edu.np',
        '078bct027.sachin@sagarmatha.edu.np',
        '078bct021.pushkar@sagarmatha.edu.np',
        '078bct012.nabin@sagarmatha.edu.np'
    ];

    // Check if the user's email exists and is in the admin list
    if (isset($user['email']) && in_array($user['email'], $admin_emails)) {
        $_SESSION['Admin_gmail'] = $user['email'];
        echo '<a href="https://poudelsangam.com.np/Assignment/superAdmin/show_user_data.php" class="hover:text-gray-300 primary px-3 py-2 rounded-md block w-1/2 m-auto">Admin</a>';
    }
}



function login_to_cr($user,$conn) {


    // Ensure email is set
    if (!isset($user['email'])) {
        return; // Exit the function if the email is not set
    }

    $email = $user['email'];

    // Query to check if the email exists in the cr table
    $query = "SELECT id FROM cr WHERE gmail = ?";
    $stmt = $conn->prepare($query);
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        return; // Exit the function if preparation fails
    }

    // Bind the email to the query
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // If the email exists in the cr table, display the CR link
        $_SESSION['user_id'] = $row['id'];
        echo '<a href="https://poudelsangam.com.np/Assignment/admin/dashboard.php" class="hover:text-gray-300 primary px-3 py-2 rounded-md block w-1/2 m-auto">CR</a>';
    }

    // Close the statement and the connection
    // $stmt->close();
    // $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Access IOE past questions and semester-wise notes for all subjects. Prepare for your exams with old question papers and detailed notes for each semester.">
    <meta name="keywords" content="IOE past questions, IOE old questions, IOE semester notes, engineering exam questions, IOE model questions, IOE question papers, IOE exam preparation, IOE first semester notes, IOE third semester past questions, IOE exam papers, engineering past papers, IOE old question papers, semester-wise IOE notes, previous year IOE questions, engineering study materials, IOE subject notes, IOE syllabus notes, IOE PDF download, Nepal IOE exam papers, IOE student resources">
    
    <link rel="icon" type="image/x-icon" href="https://niranjanbhatta.com.np/assets/smalllogo-5gRCzB8E.svg">
    <title>Assignments Dashboard</title>
    <!-- Link to Tailwind CSS -->
    <link href="https://poudelsangam.com.np/Assignment/css/styles.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
  
</head>
<body class="bg-gray-100">
    
             <!-- Loading animation -->
             
  <div id="loading-animation">

        <div class="svg-container">
        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300.000000 300.000000" preserveAspectRatio="xMidYMid meet">
            <!-- Define the gradient from blue to green -->
            <defs>
                <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#35a2f1;stop-opacity:1" /> 
                    <stop offset="100%" style="stop-color:#80d945;stop-opacity:1" /> 
                </linearGradient>
            </defs>

            <!-- SVG path for logo -->
            <g transform="translate(0.000000,300.000000) scale(0.100000,-0.100000)" stroke="none">
                <path class="path" d="M741 2710 c-40 -9 -77 -36 -105 -74 -20 -27 -21 -41 -24 -509 -2 -321 0 -494 8 -519 13 -44 66 -93 117 -107 56 -16 173 -13 226 5 60 20 102 68 116 132 6 28 10 165 10 316 0 147 3 271 6 276 9 14 968 13 1017 0 78 -22 137 -134 122 -233 -16 -106 -86 -166 -203 -175 l-68 -5 -34 64 c-44 83 -156 195 -234 236 -84 43 -139 54 -268 52 -122 -1 -158 -11 -197 -54 -24 -26 -25 -31 -25 -165 l0 -139 29 -30 c35 -36 80 -53 138 -51 83 3 97 0 123 -27 36 -38 55 -87 55 -140 0 -53 -18 -91 -60 -127 -28 -23 -40 -26 -106 -26 -45 0 -86 -6 -102 -14 -68 -36 -98 -110 -90 -230 8 -121 50 -171 157 -186 69 -10 267 3 298 18 10 6 35 18 57 28 54 26 142 115 201 204 l51 75 72 3 c78 3 112 -8 158 -55 102 -102 78 -298 -46 -361 -44 -22 -46 -22 -535 -22 -291 0 -496 4 -505 10 -12 8 -16 47 -20 214 -5 187 -7 207 -26 232 -44 59 -67 68 -181 72 -116 5 -174 -7 -211 -41 -52 -48 -52 -48 -52 -465 0 -387 0 -389 23 -422 12 -18 35 -43 50 -54 28 -21 35 -21 799 -24 851 -3 843 -3 936 59 139 94 236 239 278 415 20 85 20 296 0 381 -27 116 -111 282 -160 315 -8 5 -8 12 -1 21 112 158 147 226 169 339 59 288 -61 571 -302 717 -135 82 -69 76 -892 78 -404 1 -750 -2 -769 -7z"/>
                <path class="path_1" d="M843 2532 c-17 -2 -36 -9 -42 -16 -17 -20 -16 -806 1 -822 24 -22 54 -25 77 -7 22 18 22 22 24 373 l2 355 640 0 640 0 46 -27 c64 -38 134 -118 161 -186 18 -46 22 -77 23 -157 0 -91 -3 -106 -31 -165 -71 -151 -169 -211 -372 -229 -164 -14 -268 -87 -315 -222 -20 -56 -83 -131 -131 -157 -20 -10 -61 -16 -115 -18 -91 -2 -101 -8 -101 -59 0 -54 11 -60 97 -58 158 3 258 69 337 222 68 132 135 180 271 197 69 8 137 30 219 71 216 108 316 365 234 599 -57 163 -165 268 -308 299 -33 7 -1288 14 -1357 7z"/>
                <path class="path_1" d="M1366 1994 c-22 -21 -20 -67 2 -87 14 -13 38 -17 91 -17 47 0 85 -6 107 -16 52 -25 124 -125 124 -174 0 -11 3 -20 6 -20 10 0 94 54 94 61 0 3 -14 32 -32 65 -44 82 -123 157 -193 183 -69 26 -176 29 -199 5z"/>
                
                <path class="path_1" d="M2258 1466 l-68 -22 43 -19 c61 -27 141 -113 168 -182 20 -49 24 -76 24 -178 0 -114 -2 -123 -32 -187 -17 -37 -50 -87 -73 -112 -74 -80 -42 -77 -770 -74 l-645 3 -2 250 c-2 224 -4 251 -19 262 -37 27 -94 5 -94 -35 0 -9 -1 -143 -2 -296 -1 -261 1 -280 18 -293 15 -11 144 -13 734 -11 l715 3 51 27 c94 49 187 181 214 302 6 27 11 99 11 160 0 118 -14 183 -57 267 -26 52 -120 160 -138 158 -6 -1 -41 -11 -78 -23z"/>
                
                <path class="path" d="M1264 1700 c-82 -33 -95 -164 -23 -225 36 -29 112 -35 158 -10 34 17 61 70 61 118 0 40 -35 96 -70 114 -28 14 -95 16 -126 3z"/>
                <path class="path_1" d="M1290 1605 c-17 -20 -5 -62 20 -70 44 -14 80 41 48 73 -17 17 -53 15 -68 -3z"/>
            </g>
        </svg> 
    </div>


  </div>
<!--</div>-->

    
    
     <!-- Your actual app content will be hidden initially -->
  <div id="app-content" style="display: none;">
    <header>
        <nav class="bg-gray-800 text-white p-2">
            <div class="max-w-7xl mx-auto px-4 py-3">
                <div class="flex justify-between items-center">
                    <a href="#" class="flex items-center">
                        <img src="<?php echo htmlspecialchars($user['picture']); ?>" id="profile-picture" alt="Profile Picture" class="rounded-full h-8 w-8 mr-2">
                        <span class="text-lg font-semibold"><?php echo htmlspecialchars($user['name']); ?></span>
                    </a>
                    
                     <!-- Notification Icon -->
                <button class="relative text-white hover:bg-gray-700 py-2 px-4 rounded-md focus:outline-none md:hidden mr-auto" id="notificationButton">
                    <!-- Notification Bell Icon -->
                    <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                        <path d="M12 22a2.75 2.75 0 002.74-2.51H9.26A2.75 2.75 0 0012 22zm8.21-5.35a7.23 7.23 0 01-1.44-4.35v-3A6.5 6.5 0 0012 3a6.5 6.5 0 00-6.5 6.5v3a7.23 7.23 0 01-1.44 4.35l-1.01 1.21A1 1 0 005 20h14a1 1 0 00.75-1.64l-1.54-1.71zM12 4.5a5 5 0 015 5v3c0 1.36.26 2.67.74 3.88H6.26A9.71 9.71 0 007 12.5v-3a5 5 0 015-5z"/>
                    </svg>
                    <!-- Notification Badge -->
                    <span id="notificationBadge" class="absolute top-0 right-0 w-5 h-5 bg-red-600 rounded-full text-white text-xs flex items-center justify-center hidden">0</span>
                </button>
                
                    <button class="text-gray-400 focus:outline-none md:hidden" id="mobile-menu-button">
                        <svg xmlns="http://www.w3.org/2000/svg" id="menu-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" id="close-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="hidden md:flex md:items-center space-x-4">
                        <a href="https://poudelsangam.com.np/Assignment/index.php" class="hover:text-gray-300">Home</a>
                        <a href="https://poudelsangam.com.np/Assignment/Notes/" class="hover:text-gray-300">Notes</a>
                        <a href="https://poudelsangam.com.np/Assignment/notices/" class="hover:text-gray-300">Notices</a>
                        <a href="https://poudelsangam.com.np/Assignment/old_question/" class="hover:text-gray-300">OldQuestions</a>
                        <a href="https://poudelsangam.com.np/Assignment/sendmail/sendmail.php" class="hover:text-gray-300">SendMail</a>
                        <?php login_to_admin($user); ?>
                        <a href="https://poudelsangam.com.np/Assignment/logout.php" class="primary px-3 py-2 rounded-md">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Sidebar (for mobile) -->
    <div id="mySidebar" class="sidebar transition-transform duration-500 flex flex-col justify-between">
        <div>
            <div class="px-4 py-6">
                <div class="text-center">
                    <img src="<?php echo htmlspecialchars($user['picture']); ?>" alt="Profile Picture" class="rounded-full h-20 w-20 mx-auto mb-2">
                    <h5 class="text-xl font-bold"><?php echo htmlspecialchars($user['name']); ?></h5>
                </div>
            </div>
            <nav class="mt-6 text-start">
               <ul>
                 
                    <li>
                        <a href="https://poudelsangam.com.np/Assignment/index.php" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fs-4 bi-house"></i>
                            <span class="ml-2">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://poudelsangam.com.np/Assignment/Notes/" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fs-4 bi-file-earmark-text"></i>
                            <span class="ml-2">Notes</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://poudelsangam.com.np/Assignment/notices/" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fs-4 bi-bell"></i>
                            <span class="ml-2">Notices</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://poudelsangam.com.np/Assignment/old_question/" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fs-4 bi-archive"></i>
                            <span class="ml-2">Old Questions</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://poudelsangam.com.np/Assignment/sendmail/sendmail.php" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fs-4 bi-envelope"></i>
                            <span class="ml-2">Send Mail</span>
                        </a>
                    </li>
                        <li>
            <button class="bg-red-600 text-white font-bold py-2 px-6 rounded hover:bg-red-500 focus:outline-none focus:shadow-outline shadow-lg transition duration-200 ease-in-out" id="subscribeButton">
                Subscribe
            </button>
        </li>

                    <li><br><?php login_to_admin($user); ?><br></li>
                    <li><?php login_to_cr($user,$conn); ?></li>
                </ul>

            </nav>
        </div>
        <div class="mb-11 text-center">
            <a href="https://poudelsangam.com.np/Assignment/logout.php" class="primary px-3 py-2 rounded-md block w-1/2 m-auto">Logout</a>
        </div>
    </div>
    
<!-- Notification Overlay -->
<div id="notificationOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative transition-transform transform translate-y-0 ease-out duration-300">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-2xl font-semibold text-gray-800">Notifications</h2>
            <button id="closeOverlayButton" class="text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out">
                <!-- Close Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- Notifications List -->
        <ul id="notificationList" class="space-y-2 overflow-y-auto max-h-64">
            <li class="border-b py-3 text-gray-700">No new notifications</li>
        </ul>
        
    </div>
</div>



    <!-- Overlay -->
    <div id="overlay" class="overlay"></div>
    
    


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://poudelsangam.com.np/Assignment/js/subscription.js?v=<?php echo $version ?>"></script>
      <script src="https://poudelsangam.com.np/Assignment/js/headerJs.js?v=<?php echo $version ?>"></script>
      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>
    
</body>
</html>
