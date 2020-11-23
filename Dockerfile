FROM php:7.2-apache

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        nano \
        unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-source delete

#   Configure entry point for Apche 2
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY  . /var/www/html/

COPY .docker/.env.prod /var/www/html/.env

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www/html  \
    && composer install  && composer dumpautoload

RUN php artisan key:generate
