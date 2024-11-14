FROM php:8.2-apache

COPY . /var/www/html

RUN apt-get update && apt-get install -y php8.2-pgsql 

EXPOSE 80

