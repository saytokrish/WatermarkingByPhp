<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Load the base image
    $start_time = microtime(true);
    $imagePath = $_FILES['image']['tmp_name'];
    $watermarkText = $_POST['watermarkText'];
    
    // Create the image from the uploaded file
    $image = imagecreatefromjpeg($imagePath);

    // Set font size and color
    $fontSize = 40;
    $fontColor = imagecolorallocatealpha($image, 255, 255, 255, 50);
    $fontPath = 'C:/Windows/Fonts/arial.ttf'; // Update to your font path

    // Calculate text position
    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);
    $bbox = imagettfbbox($fontSize, 0, $fontPath, $watermarkText);
    $textWidth = $bbox[2] - $bbox[0];
    $textHeight = $bbox[1] - $bbox[7];
    $x = $imageWidth - $textWidth - 50;
    $y = $imageHeight - 200;

    // Add text watermark
    imagettftext($image, $fontSize, 0, $x, $y, $fontColor, $fontPath, $watermarkText);

    // Save the watermarked image
    $outputPath = 'watermarked_imagephp.jpg';
    imagejpeg($image, $outputPath, 90);
    imagedestroy($image);

    $end_time = microtime(true);
    $processing_time = $end_time - $start_time;
    echo "Watermarking completed in " . number_format($processing_time, 4) . " seconds.";
    // Redirect to result page
    //header('Location: result.html');
    //exit();
}
?>
