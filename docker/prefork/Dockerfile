# syntax=docker/dockerfile:1

ARG COMPOSER_VERSION=2.2.5
ARG PHP_VERSION=8.0.15-apache-bullseye
ARG PHP_EXT_INSTALLER_VERSION=1.4.13

FROM mlocati/php-extension-installer:${PHP_EXT_INSTALLER_VERSION} AS ext_installer

FROM php:${PHP_VERSION}

ENV DEBIAN_FRONTEND noninteractive
ENV LANG=C.UTF-8
ENV LC_ALL=C.UTF-8
ARG TZ=Asia/Tokyo
ENV TZ ${TZ}

COPY --from=ext_installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions

RUN install-php-extensions @composer-${COMPOSER_VERSION} gettext opcache pdo_mysql redis zip

COPY php.ini /usr/local/etc/php/php.ini
COPY 001-app.conf /etc/apache2/sites-available/001-app.conf

RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime \
    && echo ${TZ} > /etc/timezone \
    && a2enmod rewrite \
    && a2dissite 000-default \
    && a2ensite 001-app \
    && mkdir -p /var/www/laravel-load \
    && chown www-data:www-data /var/www/laravel-load



WORKDIR /var/www/laravel-load
USER www-data

COPY --chown=www-data:www-data . /var/www/laravel-load/

RUN composer install --no-dev --no-interaction --no-progress \
    && find ./storage -type d | xargs chmod 777 \
    && chmod 777 ./bootstrap/cache \
    && php artisan config:cache --no-ansi -n \
    && php artisan route:cache --no-ansi -n

EXPOSE 80
HEALTHCHECK CMD curl -f http://127.0.0.1/api
USER root
