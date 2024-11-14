FROM php:8.2-apache

COPY . /var/www/html

RUN apt-get update && apt-get install -y php-pgsql 

EXPOSE 80

