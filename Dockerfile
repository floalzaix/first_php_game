FROM php:8.2-apache

COPY . /var/www/html

RUN apt-get update -y && apt-get install php-pgsql -y

EXPOSE 80

