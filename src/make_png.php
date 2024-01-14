<?php

class Draw {
    private const WIDTH = 800;
    private const HEIGHT = 480;
    private const FONT = __DIR__.'/roboto.ttf';
    private const OUT = __DIR__.'/output.png';

    private GdImage $image;
    private int $black;
    private int $white;


    public function __construct() {    
        $this->image = imagecreatetruecolor(self::WIDTH, self::HEIGHT);
        $this->black = imagecolorallocate($this->image, 0, 0, 0);
        $this->white = imagecolorallocate($this->image, 255, 255, 255);
        imagefilledrectangle($this->image, 0, 0, self::WIDTH, self::HEIGHT, $this->white);
        imagerectangle($this->image, 0, 0, self::WIDTH-1, self::HEIGHT-1, $this->black);
    }
    
    public function akt_preis(int $cent): void {
        $this->text('aktueller Preis:', 20, 10, 40);
        $this->text($cent . ' ct', 60, 10, 120);
    }

    private function text(string $text, int $size, int $x, int $y): void {
                    // size, angle, x, y, color, font, text
        imagettftext($this->image, $size, 0, $x, $y, $this->black, self::FONT, $text);
    }
    
    public function save(): void {
        imagepng($this->image, self::OUT);    
        imagedestroy($this->image);    
    }
}

$daten = json_decode(file_get_contents(__DIR__.'/daten.json'), true);
$draw = new Draw();
$draw->akt_preis($daten['current']);
$draw->save();
