FROM php:8.2-fpm-alpine AS php

RUN apk add --no-cache \
    curl git build-base zlib-dev oniguruma-dev autoconf bash
    libjpeg-dev libpng-dev libfreetype6-dev zip unzip libonig-dev \
    libxml2-dev libzip-dev libssl-dev libpq-dev cron \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql mbstring zip exif pcntl bcmath
RUN apk add --update linux-headers

# Xdebug
ARG INSTALL_XDEBUG=false
RUN if [ ${INSTALL_XDEBUG} = true ]; \
    then \
      pecl install xdebug && docker-php-ext-enable xdebug; \
    fi;
COPY ./docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Redis
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer



# Nginx
RUN apk add --update --no-cache nginx
COPY ./docker/nginx/default.conf.template /etc/nginx/templates/default.conf
RUN chown -Rf www-data:www-data /var/lib/nginx

# Certbot
# RUN apk add --no-cache certbot python3-certbot-nginx

# Crontab
# COPY ./docker/crontab /etc/cron.d/cert-renew
# RUN chmod 0644 /etc/cron.d/cert-renew && crontab /etc/cron.d/cert-renew

# COPY --from=php /etc/cron.d/cert-renew /etc/cron.d/cert-renew
# RUN chmod 0644 /etc/cron.d/cert-renew

# Supervisor
RUN apk add --no-cache supervisor
COPY ./docker/supervisord.conf /etc/supervisord.conf

# Source code
RUN chown www-data:www-data /var/www
COPY --chown=www-data:www-data ./ /var/www
WORKDIR /var/www

# Install dependencies
ARG BUILD_MODE=dev
RUN if [ ${BUILD_MODE} = dev ]; \
    then \
      composer install; \
    else \
      composer install --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader; \
    fi;
RUN chown -R www-data:www-data /var/www/vendor/



EXPOSE 8080

CMD ["/bin/sh", "./docker/run.sh"]
