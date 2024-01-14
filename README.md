

# Docker Python Test
docker build -t waveshare-bitmap-generator-php .
docker run -it -v ./src:/src -w /src waveshare-bitmap-generator-php php test.php


# Daten von Tibber via NodeRED
curl -v http://nodered.ha.home/einkBmp > daten.json
