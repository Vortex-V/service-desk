FROM dunglas/frankenphp:latest-php8.3

LABEL maintainer = "Aleksandrov Vitaliy"

RUN install-php-extensions \
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
    && pecl install -o -f xdebug \
    && docker-php-ext-enable xdebug

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN usermod -u 1000 www-data

ENV PHP_INI_SCAN_DIR /usr/local/etc/php/local-conf.d:

WORKDIR /app

EXPOSE 9000
