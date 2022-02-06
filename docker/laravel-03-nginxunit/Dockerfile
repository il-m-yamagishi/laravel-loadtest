# syntax=docker/dockerfile:1

ARG PHP_EXT_INSTALLER_VERSION=1.4.13

FROM mlocati/php-extension-installer:${PHP_EXT_INSTALLER_VERSION} AS ext_installer

FROM nginx/unit:1.26.1-php8.0

ARG COMPOSER_VERSION=2.2.5
ENV DEBIAN_FRONTEND noninteractive
ENV LANG=C.UTF-8
ENV LC_ALL=C.UTF-8
ARG TZ=Asia/Tokyo
ENV TZ ${TZ}

COPY --from=ext_installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions

RUN install-php-extensions @composer-${COMPOSER_VERSION} gettext opcache pdo_mysql redis zip sockets

COPY php.ini /usr/local/etc/php/php.ini
COPY laravel.nginxunit.json /docker-entrypoint.d/config.json

RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime \
    && echo ${TZ} > /etc/timezone \
    && mkdir -p /var/www/laravel-load \
    && chown unit:unit /var/www/laravel-load



WORKDIR /var/www/laravel-load
USER unit:unit

COPY --chown=unit:unit . /var/www/laravel-load/

RUN composer install --no-dev --no-interaction --no-progress \
    && find ./storage -type d | xargs chmod 777 \
    && chmod 777 ./bootstrap/cache \
    && php artisan config:cache --no-ansi -n \
    && php artisan route:cache --no-ansi -n

EXPOSE 8080
HEALTHCHECK CMD curl -f http://127.0.0.1:8080

