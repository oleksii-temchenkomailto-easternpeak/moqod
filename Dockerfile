FROM php:latest

RUN apt-get update && \
    apt-get install --no-install-recommends -y \
    wget \
    zip \
    unzip \
    libicu-dev
RUN docker-php-ext-install intl

##synfony cli
#RUN wget https://get.symfony.com/cli/installer -O - | bash
#RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony
##RUN symfony server:ca:install

# Composer
RUN sh -c "curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer"
COPY ./composer.* /app/
RUN ls -laG /app
RUN cd /app && composer install --ignore-platform-reqs

COPY . /app


RUN cd /app && composer install

WORKDIR /app

#CMD ["symfony", "server:start", "--no-tls"]
CMD ["php", "-S", "127.0.0.1:8000", "-t", "public"]
