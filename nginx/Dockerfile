FROM nginx:1.15.8

COPY ./nginx/nginx.conf /etc/nginx/conf.d/default.conf
COPY ./www/html /var/www/html
COPY ./www/config /var/www/config
COPY ./www/lib/Controller /var/www/lib/Controller
COPY ./www/lib/Model /var/www/lib/Model

# COPY --from=composer /usr/bin/composer /usr/bin/composer

CMD ["nginx","-g","daemon off;"]

