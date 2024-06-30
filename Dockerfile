# Use an official PHP runtime as a parent image
FROM php:7.4-apache

RUN a2enmod rewrite
RUN docker-php-ext-install mysqli

ADD . /var/www/html