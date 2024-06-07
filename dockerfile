# Use an official PHP runtime as a parent image
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Install npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs

RUN apt-get install -y npm

# Install Tailwind CSS
RUN npm install -D tailwindcss

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Run database setup scripts
RUN php ./admin/creerBdd.php && php ./admin/create_admin.php

# Expose port 80
EXPOSE 80

# Run the PHP built-in server
CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]
