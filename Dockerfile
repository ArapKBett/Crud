FROM php:8.2-apache

RUN a2enmod rewrite

COPY . /var/www/html/
WORKDIR /var/www/html

RUN docker-php-ext-install mysqli
EXPOSE 80
