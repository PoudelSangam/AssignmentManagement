<?php
require 'vendor/autoload.php';

use setasign\Fpdi\Fpdi;

/**
 * Add an image as the first page of an existing PDF.
 *
 * @param string $existingPdfPath Path to the existing PDF file.
 * @param string $newImagePath Path to the image file to add as the first page.
 * @param string $outputPdfPath Path to save the modified PDF file.
 */
function addImageAsFirstPage($existingPdfPath, $newImagePath, $outputPdfPath)
{
    // Initialize FPDI
    $pdf = new FPDI();

    // Get A4 page size in points (width: 210mm, height: 297mm)
    $a4WidthPoints = 210;  // Points for A4 width
    $a4HeightPoints = 297; // Points for A4 height

    // Get the dimensions of the image
    list($imgWidth, $imgHeight) = getimagesize($newImagePath);

    // Calculate the scaling factor to maintain aspect ratio
    $scale = min($a4WidthPoints / $imgWidth, $a4HeightPoints / $imgHeight);

    // Calculate new image dimensions
    $newWidth = $imgWidth * $scale;
    $newHeight = $imgHeight * $scale;

    // Center the image on the A4 page
    $xOffset = ($a4WidthPoints - $newWidth) / 2;
    $yOffset = ($a4HeightPoints - $newHeight) / 2;

    // Add a new page to place the image
    $pdf->AddPage('P', [$a4WidthPoints, $a4HeightPoints]);
    $pdf->Image($newImagePath, $xOffset, $yOffset, $newWidth, $newHeight);

    // Load the existing PDF and add its pages after the new page
    $pageCount = $pdf->setSourceFile($existingPdfPath);

    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $templateId = $pdf->importPage($pageNo);
        $size = $pdf->getTemplateSize($templateId);

        // Add each page from the existing PDF to the new PDF
        $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
        $pdf->useTemplate($templateId);
    }

    // Save the new PDF
    $pdf->Output('F', $outputPdfPath);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $faculty = $_POST['faculty'];
    $semester = $_POST['semester'];
    $batch = $_POST['batch'];
    $subject = $_POST['subject'];

    // Handling the uploaded image file
    $imageTmpPath = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];

    // Define the path to save the uploaded image in the img folder
    $imageSavePath = './img/' . $imageName;

    // Move the uploaded image to the img folder
    if (move_uploaded_file($imageTmpPath, $imageSavePath)) {
        // Existing PDF path (dynamically generated)
        $existingPdfPath = "../../old_question/file/$batch/$faculty/$semester/$subject.pdf";

        // Output path for the modified PDF
        $outputPdfPath = "../../old_question/file/$batch/$faculty/$semester/$subject.pdf";

        // Call the function to add the image as the first page
        addImageAsFirstPage($existingPdfPath, $imageSavePath, $outputPdfPath);

        echo "Image successfully saved to: $imageSavePath<br>";
        echo "PDF has been successfully modified and saved to: $outputPdfPath";
    } else {
        echo "Error: Unable to save the image.";
    }
}
?>
