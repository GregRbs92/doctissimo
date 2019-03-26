FROM php:7.2-fpm-alpine

RUN apk update \
    && apk add  --no-cache mysql-client curl libmcrypt libmcrypt-dev openssh-client icu-dev \
    libxml2-dev freetype-dev libpng-dev libjpeg-turbo-dev g++ make autoconf \
    && docker-php-source extract \
    && pecl install xdebug redis \
    && docker-php-ext-enable xdebug \
    && docker-php-source delete \
    && docker-php-ext-install pdo_mysql soap intl zip \
    && rm -rf /tmp/*

WORKDIR /var/www/doctissimo

CMD ["./docker/php/entrypoint.sh"]

EXPOSE 9000
