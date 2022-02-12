# syntax=docker/dockerfile:1

ARG PHP_VERSION=8.0.14-fpm-bullseye
ARG PHP_EXT_INSTALLER_VERSION=1.4.13

FROM mlocati/php-extension-installer:${PHP_EXT_INSTALLER_VERSION} AS ext_installer

FROM php:${PHP_VERSION}

ARG COMPOSER_VERSION=2.2.5
ENV DEBIAN_FRONTEND noninteractive
ENV LANG=C.UTF-8
ENV LC_ALL=C.UTF-8
ARG TZ=Asia/Tokyo
ENV TZ ${TZ}

COPY --from=ext_installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions

RUN install-php-extensions @composer-${COMPOSER_VERSION} gettext opcache pdo_mysql pcntl redis zip sockets

COPY php.ini /usr/local/etc/php/php.ini

RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime \
    && echo ${TZ} > /etc/timezone \
    && mkdir -p /var/www/laravel-load \
    && chown www-data:www-data /var/www/laravel-load



WORKDIR /var/www/laravel-load
USER www-data

COPY --chown=www-data:www-data . /var/www/laravel-load/

RUN composer install --no-dev --no-interaction --no-progress \
    && find ./storage -type d | xargs chmod 777 \
    && chmod 777 ./bootstrap/cache

EXPOSE 9000
USER root
