# syntax=docker/dockerfile:1

ARG PHP_VERSION=8.0.14-cli-bullseye
ARG PHP_EXT_INSTALLER_VERSION=1.4.13
ARG RR_VERSION=2.7.4

# RoadRunner イメージ
FROM ghcr.io/roadrunner-server/roadrunner:${RR_VERSION} AS rr

FROM mlocati/php-extension-installer:${PHP_EXT_INSTALLER_VERSION} AS ext_installer

FROM php:${PHP_VERSION}

ARG COMPOSER_VERSION=2.2.5
ENV DEBIAN_FRONTEND noninteractive
ENV LANG=C.UTF-8
ENV LC_ALL=C.UTF-8
ARG TZ=Asia/Tokyo
ENV TZ ${TZ}

COPY --from=rr /usr/bin/rr /usr/bin/
COPY --from=ext_installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions

RUN install-php-extensions @composer-${COMPOSER_VERSION} gettext opcache pdo_mysql redis zip sockets

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
    && chmod 777 ./bootstrap/cache \
    && php artisan config:cache --no-ansi -n \
    && php artisan route:cache --no-ansi -n

USER root
CMD [ "php", "artisan", "octane:start", "--rr-config=.rr.yaml", "--server=roadrunner", "--host=0.0.0.0", "--port=80", "--rpc-port=6001" ]
EXPOSE 80 6001
