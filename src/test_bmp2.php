<?php
function createBMP($text, $filename) {
    // Image dimensions
    $width = 200;
    $height = 100;

    // Create a blank image
    $image = imagecreate($width, $height);

    // Define colors
    $black = imagecolorallocate($image, 0, 0, 0);
    $white = imagecolorallocate($image, 255, 255, 255);

    // Fill the image with black background
    imagefilledrectangle($image, 0, 0, $width, $height, $black);

    // Set font settings
    $font = 4;  // Adjust as needed
    $x = 10;    // X-coordinate of the text
    $y = 40;    // Y-coordinate of the text

    // Add white text to the image
    imagestring($image, $font, $x, $y, $text, $white);

    // Save the image as BMP
    imagewbmp($image, $filename);

    // Free up memory
    imagedestroy($image);
}

// Usage
$text = "Hello, BMP!";
$filename = "output.bmp";
createBMP($text, $filename);
echo "BMP file created: $filename";
?>
