FROM centos:latest

RUN apt-get update && apt-get install -y nginx

COPY ./www/html /var/www/html
COPY ./www/config /var/www/config
COPY ./www/lib/Controller /var/www/lib/Controller
COPY ./www/lib/Model /var/www/lib/Model

COPY --from=composer /usr/bin/composer /usr/bin/composer

CMD ["nginx","-g","daemon off;"]