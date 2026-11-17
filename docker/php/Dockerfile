FROM php:8.5-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
      git unzip libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j"$(nproc)" pdo_mysql bcmath intl gd zip \
 && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
