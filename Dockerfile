FROM php:8.2-cli

RUN apt-get update
RUN apt-get -y install libzip-dev libpng-dev
#RUN apt-get install php8.2-gd
RUN docker-php-ext-install gd
