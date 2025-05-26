FROM php:8.3-fpm

LABEL maintainer = "Aleksandrov Vitaliy"

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    libmemcached-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libxml2-dev \
    libfreetype6-dev \
    libreadline-dev \
    libgmp-dev \
    libzip-dev

RUN docker-php-ext-install \
        pdo_pgsql \
        pcntl \
        exif \
        xml \
        intl \
        zip \
        gd

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Xdebug
RUN pecl channel-update pecl.php.net \
    && pecl install -o -f xdebug

ADD php/php.ini /usr/local/etc/php/conf.d

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN usermod -u 1000 www-data

ENV PHP_INI_SCAN_DIR /usr/local/etc/php/local-conf.d:

WORKDIR /app

EXPOSE 9000
CMD ["php-fpm"]
