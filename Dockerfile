FROM php:8.0-fpm
#php
#ADD http://github.com/mlocati/docker-php-extension-installer/releases/latest/donwload/install-php-extensions

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo_mysql mbstring

WORKDIR /app
COPY composer.json .

RUN composer install --no-scripts
COPY . .

CMD ["npm", "run", "prod"]

CMD php artisan serve --port=8000
