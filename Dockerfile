# Use the official PHP-Apache base image
FROM php:8.2-apache

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite

# Copy all project files (since everything is now in root)
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install MySQLi extension
RUN docker-php-ext-install mysqli

# (Optional) Set default environment variables for local dev
ENV DB_HOST=localhost
ENV DB_USER=root
ENV DB_PASS=root
ENV DB_NAME=crudeoperation

EXPOSE 80
