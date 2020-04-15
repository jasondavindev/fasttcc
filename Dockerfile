FROM php:7.0-apache

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt update && apt install -y \
  build-essential && \
  apt-get clean && rm -rf /var/lib/apt/lists/* && \
  docker-php-ext-install pdo_mysql

# Expose port 9000 and start php-fpm server
EXPOSE 80
