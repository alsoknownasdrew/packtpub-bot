FROM php:7.3.3-cli-alpine3.9

RUN curl --silent https://getcomposer.org/download/1.8.4/composer.phar > /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

WORKDIR /app

COPY composer.json /app
COPY composer.lock /app

RUN composer install \
        --no-dev \
        --prefer-dist \
        --no-progress \
        --no-suggest \
        --no-interaction \
        --no-scripts \
        --optimize-autoloader && \
    composer clear-cache

COPY . /app
