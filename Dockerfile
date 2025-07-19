# Use the official PHP-Apache base image
FROM php:8.2-apache

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite

# Copy all project files to the container's web root
COPY public/ /var/www/html/
COPY dbconnection.php /var/www/html/dbconnection.php

# Set working directory
WORKDIR /var/www/html

# Install MySQLi extension
RUN docker-php-ext-install mysqli

# Set environment variables (optional defaults)
ENV DB_HOST=localhost
ENV DB_USER=root
ENV DB_PASS=root
ENV DB_NAME=crudeoperation

# Expose web server port
EXPOSE 80
