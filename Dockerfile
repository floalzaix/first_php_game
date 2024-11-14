FROM php:8.2-apache

# Copies your code file from your action repository to the filesystem path `/` of the container
COPY . /var/www/html


EXPOSE 80