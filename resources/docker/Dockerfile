ARG COMPOSER_VERSION=2.4.4
ARG PHP_VERSION=8.1
ARG SWOOLE_VERSION=4.8

FROM composer:${COMPOSER_VERSION} AS dockyard
WORKDIR /app
COPY . .
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-progress \
    --no-ansi \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

FROM phpswoole/swoole:${SWOOLE_VERSION}-php${PHP_VERSION}-alpine
RUN apk --no-cache upgrade && \
    apk --no-cache add bash openssh autoconf gcc g++ make libxml2-dev oniguruma-dev libzip-dev
RUN docker-php-ext-install pdo pdo_mysql mbstring xml zip pcntl bcmath pdo
RUN docker-php-ext-enable pdo pdo_mysql mbstring xml zip pcntl bcmath pdo

COPY --from=dockyard /usr/bin/composer /usr/bin/composer
COPY --from=dockyard /app /app

WORKDIR /app

ENTRYPOINT  ["bash", "/app/resources/docker/start.sh"]
