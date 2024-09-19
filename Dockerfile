# Stage 1: PHP 8.2 with Composer and other dependencies
FROM php:8.2-fpm AS php

# Установка необходимых пакетов
RUN apt-get update && apt-get install -y \
    libjpeg-dev libpng-dev libfreetype6-dev zip unzip git curl libonig-dev \
    libxml2-dev libzip-dev libssl-dev cron \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip exif pcntl bcmath

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копирование crontab
COPY ./docker/crontab /etc/cron.d/cert-renew
RUN chmod 0644 /etc/cron.d/cert-renew && crontab /etc/cron.d/cert-renew

# Stage 2: Nginx with Certbot
FROM nginx:latest

# Установка Certbot
RUN apt-get update && apt-get install -y certbot python3-certbot-nginx cron

# Копирование конфигурации Nginx
COPY ./docker/nginx/default.conf.template /etc/nginx/templates/default.conf

# Копирование crontab для обновления сертификатов
COPY --from=php /etc/cron.d/cert-renew /etc/cron.d/cert-renew
RUN chmod 0644 /etc/cron.d/cert-renew

# Настройка рабочей директории
WORKDIR /var/www

# Копируем проект
COPY . .

# Открываем порты
EXPOSE 80 443

# Запуск Nginx и cron
CMD ["sh", "-c", "certbot --nginx --non-interactive --agree-tos --register-unsafely-without-email --redirect --no-eff-email -d $DOMAIN && cron && nginx -g 'daemon off;'"]