<?php
include_once "../version.php";
session_start();
include_once "../header.php";

// Get 'id' (pdf_name), 'semester', 'faculty', and 'subject' from the URL, and sanitize them
$name = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$semester = isset($_GET['semester']) ? htmlspecialchars($_GET['semester']) : '';  // Default is an empty string
$faculty = isset($_GET['faculty']) ? htmlspecialchars($_GET['faculty']) : '';    // Default is an empty string
$subject = isset($_GET['subject']) ? htmlspecialchars($_GET['subject']) : '';    // Default is an empty string

// There's no need to decode a regular string
$decodedName = $name;  // Directly use the sanitized name

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
    <style>
        #pdf-container {
            width: 100%;
            height: 90vh; /* Adjust the height as needed */
            border: none;
        }
    </style>
</head>
<body>

<div id="pdf-container"></div>

<script>
    const pdfName = <?php echo json_encode($decodedName); ?>;  // Encode as JSON for JavaScript usage
    const faculty = <?php echo json_encode($faculty); ?>;  // Encode faculty
    const semester = <?php echo json_encode($semester); ?>;  // Encode semester
    const subject = <?php echo json_encode($subject); ?>;  // Encode subject
    
    // Construct the PDF URL dynamically using faculty, semester, subject, and pdf name
    const pdfUrl = `https://poudelsangam.com.np/Assignment/Notes/file/${encodeURIComponent(faculty)}/${encodeURIComponent(semester)}/${encodeURIComponent(subject)}/${encodeURIComponent(pdfName)}`;

    function loadPDFViewer(pdfUrl) {
        const viewerUrl = 'https://mozilla.github.io/pdf.js/web/viewer.html?file=' + encodeURIComponent(pdfUrl);
        const iframe = document.createElement('iframe');
        iframe.src = viewerUrl;
        iframe.width = '100%';
        iframe.height = '100%';
        iframe.style.border = 'none';

        // Clear existing content (if any) and append the new iframe
        const container = document.getElementById('pdf-container');
        container.innerHTML = '';  // Clear the container
        container.appendChild(iframe);
    }

    loadPDFViewer(pdfUrl);
</script>

<?php
include_once "../footer.php";
?>

</body>
</html>
