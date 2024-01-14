<?php

class Draw {
    private const WIDTH = 800;
    private const HEIGHT = 480;
    private const FONT = __DIR__.'/roboto.ttf';

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
        $this->text('aktueller Preis:', 20, 40, 80);
        $this->text($cent . ' ct', 60, 240, 80);
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

        // Legende..
        $label_preis = [40, 35, 30, 25, 20, 15, 10, 5, 0];
        foreach ($label_preis as $l) {
            $diff = intval(($max_preis - $l) / $max_preis * $max_height);
            $this->label(120 + $diff, '' . $l);
        }

        // Balken ausgeben
        for ($hour = 0; $hour < 24; $hour++) {
            $preis = round($liste[$hour] * 100); // ct
            $height = round($preis / $max_preis * $max_height);
            $this->balken($x, $height, $hour, $preis);
            $x+= $nutzbreite;
        }
    }

    private function balken(int $x, int $height, int $hour, int $preis): void {
        $y = 120;
        $y_hoehe = 300;
        $balken_breite = 10;
        imagefilledrectangle($this->image, $x, $y + ($y_hoehe - $height), $x + $balken_breite, $y + $y_hoehe , $this->black);
        $this->text($hour, 10, $x, $y + 300 + 20);
        $this->text($preis, 10, $x, $y + 300 + 40);
        if ((int)date('H') === $hour) {
            imagerectangle($this->image,  $x - 7, $y + 300 + 5, $x + 20, $y + 300 + 45, $this->black);
        }
    }

    private function label(int $y, string $text) {
        imagesetstyle($this->image, [
            $this->black,$this->black, $this->black, $this->black,$this->black,
            $this->white,$this->white,$this->white,$this->white,$this->white
        ]);
        imageline($this->image, 40, $y, 750, $y, IMG_COLOR_STYLED);
        $this->text($text, 10, 10, $y + 5);
    }

    private function text(string $text, int $size, int $x, int $y): void {
                    // size, angle, x, y, color, font, text
        imagettftext($this->image, $size, 0, $x, $y, $this->black, self::FONT, $text);
    }
    
    public function save(string $datei): void {
        imagepng($this->image, $datei);    
        imagedestroy($this->image);    
    }
}

$json_datei = $argv[1];
$output_png = $argv[2];
if (empty($json_datei) || empty($output_png)) {
    print "Aufruf: make_png.php /tmp/daten.json /tmp/output.png\n";
}
$daten = json_decode(file_get_contents($json_datei), true);
$draw = new Draw();
$draw->akt_preis($daten['current']);
$draw->preise_heute($daten['today']);
$draw->save($output_png);
