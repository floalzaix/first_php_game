FROM php:8.2-apache

COPY . /var/www/html

RUN apt update -y && apt install php_pgsql -y

EXPOSE 80

