FROM ubuntu:latest

RUN apt update && apt dist-upgrade -y
RUN apt install software-properties-common -y
RUN apt install supervisor -y
RUN add-apt-repository ppa:ondrej/php
RUN add-apt-repository ppa:ondrej/nginx-mainline

RUN apt update && \
    apt install nginx php8.3-fpm php8.3-phalcon5 php8.3-mysql php8.3-zip php8.3-cli php8.3-xdebug -y

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./site /srv/www
WORKDIR /srv/www

RUN composer install

# load env
RUN echo "clear_env = no" >> /etc/php/8.3/fpm/pool.d/www.conf

RUN mkdir -p /var/log/supervisor
COPY ./docker-compose/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
CMD ["/usr/bin/supervisord"]