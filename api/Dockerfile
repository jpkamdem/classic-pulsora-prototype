FROM php:8.3-apache

RUN apt-get update && apt-get install -y libpq-dev curl

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN sed -i 's/80/8000/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

RUN docker-php-ext-install pdo_pgsql

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data .

EXPOSE 8000