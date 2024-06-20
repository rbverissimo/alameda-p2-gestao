FROM php:7.4-fpm

COPY composer.json composer.lock ./
RUN composer install

COPY . /var/www/app
WORKDIR /var/www/app

RUN  chown -R www-data:www-data /var/www/app
RUN  chmod -R 775 /var/www/app/storage

EXPOSE 9000