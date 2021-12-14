FROM php:7.2-apache

RUN apt-get update && docker-php-ext-install pdo_mysql 

COPY ./php.ini /usr/local/etc/php/
COPY ./www/html /var/www/html
COPY ./www/config /var/www/config
COPY ./www/lib/Controller /var/www/lib/Controller
COPY ./www/lib/Model /var/www/lib/Model

ENTRYPOINT []
CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-enabled/000-default.conf /etc/apache2/ports.conf && docker-php-entrypoint apache2-foreground