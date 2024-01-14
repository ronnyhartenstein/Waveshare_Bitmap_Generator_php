<?php
function createPNG(array $daten) {    
    $width = 800;
    $height = 480;

    $image = imagecreatetruecolor($width, $height);

    
    $black = imagecolorallocate($image, 0, 0, 0);
    $white = imagecolorallocate($image, 255, 255, 255);

    imagefilledrectangle($image, 0, 0, $width, $height, $white);
    imagerectangle($image, 0, 0, $width-1, $height-1, $black);

    
    $font = __DIR__.'/roboto.ttf';  

    $size = 20;
    $x = 10;
    $y = 40;
    $text = 'aktueller Preis:';

    imagettftext($image, $size, 0, $x, $y, $black, $font, $text);


    $size = 60;
    $x = 10;
    $y = 100;
    $text = $daten['current'] . ' ct';
                // size, angle, x, y, color, font, text
    imagettftext($image, $size, 0, $x, $y, $black, $font, $text);

    
    imagepng($image, 'output.png');

    
    imagedestroy($image);
}

$daten = json_decode(file_get_contents(__DIR__.'/daten.json'), true);
createPNG($daten);
