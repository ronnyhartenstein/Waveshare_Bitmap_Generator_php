# Idee
1. Daten liegen als Datei vor (legt NodeRED dahin)
2. PHP Script baut PNG aus Daten
3. ImageMagick konvertiert zu monochrome BMP


# Docker Image bauen

`docker build -t waveshare-bitmap-generator-php .`

und Script ausführen ..

`docker run -it -v ./src:/src -w /src waveshare-bitmap-generator-php php make_png.php`


# Daten von Tibber via NodeRED
`curl -v http://nodered.ha.home/einkBmp > daten.json``


# Convert PNG zu BMP
`docker run -it -v ./src:/src -w /src waveshare-bitmap-generator-php convert output.png -monochrome output.png.bmp``
`