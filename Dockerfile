FROM php:8.2-apache

COPY . /var/www/html

RUN docker-php-ext_install pdo pdo_pgsql

EXPOSE 80