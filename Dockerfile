FROM php:7.4-cli

COPY src/composer.json src/composer.lock ./

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin
RUN composer install

COPY . /var/www/app
WORKDIR /var/www/app

RUN  chown -R www-data:www-data /var/www/app
RUN  chmod -R 775 /var/www/app/storage

EXPOSE 9000