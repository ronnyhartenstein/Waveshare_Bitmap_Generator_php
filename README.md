# Idee
1. Daten liegen als Datei vor (legt NodeRED dahin)
2. PHP Script baut BMP/PNG aus Daten
3. ImageMagick konvertiert zu sinnvollen Format


# Docker Python Test
docker build -t waveshare-bitmap-generator-php .
docker run -it -v ./src:/src -w /src waveshare-bitmap-generator-php php test.php


# Daten von Tibber via NodeRED
curl -v http://nodered.ha.home/einkBmp > daten.json



# Convert PNG zu BMP
docker run -it -v ./src:/src -w /src waveshare-bitmap-generator-php convert output.png -monochrome output.png.bmp

# Test BMPs
https://cloud.chemnitz.freifunk.net/apps/files/?dir=/Waveshare_Test&fileid=119016

wget https://cloud.chemnitz.freifunk.net/s/wXSZokxmCq8WCPs/download/test_8bit_sw.bmp