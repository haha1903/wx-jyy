FROM php:apache
COPY ./ /var/www/html/
RUN rm /var/www/html/Dockerfile
RUN rm /var/www/html/docker-compose.yml

