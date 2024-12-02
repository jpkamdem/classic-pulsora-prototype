FROM php:8.3-apache

RUN apt-get update && apt-get install -y libpq-dev

RUN docker-php-ext-install pdo_pgsql

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data .

EXPOSE 80