FROM php:apache
RUN apt-get update && apt-get upgrade
COPY ./ /var/www/html/
RUN rm /var/www/html/Dockerfile
RUN rm /var/www/html/docker-compose.yml
