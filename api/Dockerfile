FROM php:8.1-cli

RUN apt-get update && apt-get install -y libpq-dev

RUN docker-php-ext-install pdo_pgsql

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data .

EXPOSE 80