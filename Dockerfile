FROM php:latest

RUN apt-get update && \
    apt-get install --no-install-recommends -y \
    wget \
    zip \
    unzip \
    libicu-dev
RUN docker-php-ext-install intl

#RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

#synfony cli
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony
#RUN symfony server:ca:install

# Composer
RUN sh -c "curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer"
COPY ./composer.* /app/
RUN cd /app && composer install --ignore-platform-reqs

COPY . /app


RUN cd /app && composer install

WORKDIR /app

CMD ["symfony", "server:start", "--no-tls"]
