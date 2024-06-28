FROM php:8.2.6-apache

# Включаем mod_rewrite
RUN a2enmod rewrite

RUN pecl install xdebug-3.3.2 \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo_mysql

COPY ./xdebug.ini "${PHP_INI_DIR}/conf.d"