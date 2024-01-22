FROM nginx:1.19

COPY ./test/ /var/www/html
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/sites/ /etc/nginx/sites-available
COPY ./docker/nginx/conf.d/ /etc/nginx/conf.d

CMD ["nginx"]

EXPOSE 80 443
