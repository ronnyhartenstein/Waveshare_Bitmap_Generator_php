FROM php:8.2-cli

RUN apt-get update
RUN apt-get -y install imagemagick
RUN apt-get -y install libzip-dev libpng-dev libfreetype6-dev 
RUN docker-php-ext-configure gd --with-freetype=/usr/include/
RUN docker-php-ext-install gd 
