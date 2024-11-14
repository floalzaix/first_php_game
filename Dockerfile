FROM php:8.2-apache

COPY . /var/www/html

RUN apt update && apt install pdo_pgsql;

EXPOSE 80