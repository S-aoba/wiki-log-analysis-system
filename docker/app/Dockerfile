FROM php:8-apache

WORKDIR /app

RUN docker-php-ext-install pdo_mysql

COPY ./app /app
