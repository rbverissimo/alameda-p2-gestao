FROM php:7.4-fpm

RUN apt-get update -y && apt-get install -y openssl zip unzip git

COPY composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

COPY composer.json composer.lock ./
RUN composer install

COPY . .

RUN mkdir -p /var/www/app/database
RUN mkdir -p /var/www/app/storage

COPY . /var/www/app
WORKDIR /var/www/app

RUN  chown -R www-data:www-data /var/www/app
RUN  chmod -R 775 /var/www/app/storage

EXPOSE 9000