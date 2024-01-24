# Idee
1. Daten liegen als Datei vor (legt NodeRED dahin)
2. PHP Script baut PNG aus Daten
3. ImageMagick konvertiert zu monochrome BMP


# Laufen lassen

`docker compose run app php make_png.php /tmp_host/tibber_daten.json /tmp_host/tibber_output.png`


# Daten von Tibber via NodeRED
`curl -v http://nodered.ha.home/einkBmp > daten.json``


# Convert PNG zu BMP
`docker compose run app convert /tmp_host/tibber_output.png -monochrome /tmp_host/tibber_output.bmp`

