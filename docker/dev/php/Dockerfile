FROM php:7.3.3-cli-alpine3.9

RUN curl --silent https://getcomposer.org/download/1.8.4/composer.phar > /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-2.7.1 \
    && docker-php-ext-enable xdebug

COPY dev/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
