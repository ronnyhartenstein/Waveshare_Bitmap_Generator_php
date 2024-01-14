<?php

// Function to create a monochrome image
function createMonochromeBitmap($width, $height, $pixels) {
    $image = imagecreate($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);

    // Draw pixels on the image
    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            $pixelValue = $pixels[$y * $width + $x];
            imagesetpixel($image, $x, $y, $pixelValue ? $white : $black);
        }
    }

    return $image;
}

// Function to save the image as a BMP file
function saveBitmap($image, $filename) {
    imagewbmp($image, $filename);
}

// Example usage
$width = 64;
$height = 64;
$pixels = array_fill(0, $width * $height, 0); // Initialize with zeros (black)

// Set some pixels to white (1)
$pixels[10] = 1;
$pixels[20] = 1;
$pixels[30] = 1;

$monochromeImage = createMonochromeBitmap($width, $height, $pixels);
saveBitmap($monochromeImage, 'output.bmp');

// Output a message or redirect to the saved BMP file
echo 'Image saved as output.bmp';