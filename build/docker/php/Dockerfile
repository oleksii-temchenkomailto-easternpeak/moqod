FROM php:7.4-fpm

RUN apt-get update && \
    apt-get install --no-install-recommends -y \
    wget \
    zip \
    unzip \
    libicu-dev
RUN docker-php-ext-install intl

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

WORKDIR /app
