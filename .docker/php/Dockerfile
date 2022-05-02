FROM php:7.4.24-fpm
ARG TIMEZONE

COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

### -o para conectar al proxy
RUN apt-get update

### -o para conectar al proxy
RUN apt-get install -y \
    gnupg \
    g++ \
    procps \
    openssl \
    git \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg-dev \
    libicu-dev  \
    libonig-dev \
    libxslt1-dev \
    acl \
    && echo 'alias sf="php bin/console"' >> ~/.bashrc

RUN docker-php-ext-configure gd --with-jpeg --with-freetype

RUN docker-php-ext-install \
    pdo pdo_mysql zip xsl gd intl opcache exif mbstring

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

### -x ip:puerto para conectar al proxy
RUN curl https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

### Hacer el proceso de instalar Composer de manera local
# COPY composer-setup.php /composer-setup.php
# RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
# RUN rm composer-setup.php

WORKDIR /var/www/movies
RUN ls