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

    public function preise_heute(array $liste): void {
        // 24h, beginnend bei 0
        // 800 breit, 40 li, 40 re frei lassen
        // 30 px nutzbreite je h (720) 
        // 10 px balken, 20px platz
        $x = 40;
        $nutzbreite = 30;

        // Graph-Höhe 300
        $max_height = 300;
        $max_preis = 40;
        $min_height = 0;
        $min_preis = -5;
        $preis_spread = $max_preis - $min_preis;
        for ($hour = 0; $hour < 24; $hour++) {
            $ct = round($liste[$hour] * 100); // ct
            $ct_rel= $ct + $min_preis;
            $ct_rel_max = $max_preis + $min_preis;
            $height = round($ct_rel / $ct_rel_max * $max_height);
            $this->balken($x, $height, $hour, $ct);
            $x+= $nutzbreite;
        }
    }

    private function balken(int $x, int $height, int $hour, int $preis_ct): void {
        $y = 120;
        $balken_breite = 10;
        imagefilledrectangle($this->image, $x, $y, $x + $balken_breite, $y + $height , $this->black);
        $this->text($hour, 10, $x, $y + 300 + 20);
        $this->text($preis_ct, 10, $x, $y + 300 + 40);
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
$draw->preise_heute($daten['today']);
$draw->save();
