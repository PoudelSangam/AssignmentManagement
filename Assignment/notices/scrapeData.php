<?php
// Include your database connection
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Ensure the script is being run from the CLI (Command Line Interface)
// if (php_sapi_name() !== 'cli') {
//     die('Nice try');
// }
$baseDir = __DIR__; // gets the directory of the current file
include_once ($baseDir ."/../db.php");
include_once ($baseDir ."/../send_notification/send_notification.php");

// Initialize cURL to fetch notices from the external URL
$url = 'http://exam.ioe.edu.np/'; // The URL where the notices are located
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Load the HTML response into DOMDocument
$dom = new DOMDocument();
libxml_use_internal_errors(true); // Suppress HTML parsing errors
$dom->loadHTML($response);
libxml_clear_errors();

// Create a new XPath to query the DOM
$xpath = new DOMXPath($dom);

// Query to select the rows in the table
$notices = $xpath->query("//table[@id='datatable']/tbody/tr");

$results = [];

// Define keywords for filtering
$keywords = ['Exam Center', 'Online Form : BE/BAR', 'Routine: BE/BAR', 'Result: BE'];

foreach ($notices as $notice) {
    $titleNode = $xpath->query(".//td[2]/a", $notice);
    $title = $titleNode->item(0)->nodeValue; // Title

    // Check if the title contains any of the keywords
    foreach ($keywords as $keyword) {
        if (strpos($title, $keyword) !== false) {
            $sno = $xpath->query(".//td[1]", $notice)->item(0)->nodeValue; // Serial Number
            $link = $titleNode->item(0)->getAttribute('href'); // Link
            $date = $xpath->query(".//td[3]", $notice)->item(0)->nodeValue; // Notice Date

            // Store results in an array
            $results[] = [
                'sno' => $sno,
                'title' => $title,
                'link' => $link,
                'date' => $date,
            ];
            break; // Stop checking other keywords if one matches
        }
    }
}

// Check and insert new notices into the database
foreach ($results as $notice) {
    $sno = $notice['sno'];
    $title = $notice['title'];
    $link = $notice['link'];
    $date = $notice['date'];

    // Check if the notice already exists in the database
    $sql = "SELECT COUNT(*) as count FROM notice WHERE title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // If the notice doesn't exist, insert it
    if ($row['count'] == 0) {
        $insert_sql = "INSERT INTO notice (title) VALUES (?)";
        $stmt_insert = $conn->prepare($insert_sql);
        $stmt_insert->bind_param("s", $title);
        $stmt_insert->execute();
        
  
       
        $faculty = '0'; // Define faculties to target
        $body = " "; // Notification message body
        $college = '0';
        $intake_year = '0';

                // Call the notification function for each faculty and intake year combination
                sendNotifications($conn, $intake_year, $faculty, $college, $title, $body);
                

            }
        


          
    
}

// echo "Data has been updated.";
?>
