FROM php:7.4-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY ./html /var/www/html

RUN chown -R www-data:www-data /var/www/html

EXPOSE 8000