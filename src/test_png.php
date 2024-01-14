<?php
function createPNG($text, $filename) {
    // Image dimensions
    $width = 200;
    $height = 100;

    // Create a blank image
    $image = imagecreatetruecolor($width, $height);

    // Define colors
    $black = imagecolorallocate($image, 0, 0, 0);
    $white = imagecolorallocate($image, 255, 255, 255);

    // Fill the image with white background
    imagefilledrectangle($image, 0, 0, $width, $height, $white);

    // Set font settings
    $font = 4;  // Adjust as needed
    $x = 10;    // X-coordinate of the text
    $y = 40;    // Y-coordinate of the text

    // Add black text to the image
    imagestring($image, $font, $x, $y, $text, $black);

    // Save the image as PNG
    imagepng($image, $filename);

    // Free up memory
    imagedestroy($image);
}

// Usage
$text = "Hello, PNG!";
$filename = "output.png";
createPNG($text, $filename);
echo "PNG file created: $filename";
?>