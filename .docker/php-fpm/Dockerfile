ARG VERSION
ARG COMPOSER_VERSION
ARG PHP_VERSION

FROM php:8.1.11-fpm-alpine3.15 AS builder

ARG VERSION

ARG TIMEZONE

RUN apk upgrade --no-cache \
  && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
  \
  # TIMEZONE (SYSTEM + PHP)
  && apk add --no-cache tzdata \
  && ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
  && echo ${TIMEZONE} > /etc/timezone \
  \
  # PHP OPCache
  && docker-php-ext-install opcache \
  && docker-php-ext-enable opcache \
  \
  # PHP pdo_mysql
  && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
  && docker-php-ext-install pdo_mysql \
  \
  # PHP APCU
  && pecl install apcu \
  && docker-php-ext-enable apcu \

   # Cleaning
   && apk del --purge .build-deps \
   && docker-php-source delete \


COPY php-fpm/config/conf.d/*.ini ${PHP_INI_DIR}/conf.d/

COPY php-fpm/config/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf

COPY php-fpm/config/php.ini ${PHP_INI_DIR}/

ARG APP_CODE_PATH

WORKDIR ${APP_CODE_PATH}


#----------------------------------------------------------------------------

FROM composer:latest AS composer


# ----------------------------------------------------------------------------
#  DEV TARGET
# ----------------------------------------------------------------------------

FROM builder AS dev

ENV APP_ENV=dev

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache nano mysql-client

CMD ["php-fpm"]

RUN echo ls -1
# ----------------------------------------------------------------------------
#  TEST TARGET
# ----------------------------------------------------------------------------

