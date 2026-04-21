FROM php:8.5-fpm AS prod

WORKDIR /var/www

RUN apt-get update
RUN apt-get install -y curl

####################
# git
####################
RUN apt-get install -y git
RUN git config --global user.email "simposium@ya.ru" && git config --global user.name "alxrzhnkv"

####################
# zip
####################
RUN apt-get install -y zip unzip libzip-dev
RUN docker-php-ext-install zip

####################
# PHP db
####################
RUN docker-php-ext-install pdo pdo_mysql

####################
# composer
####################
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer


####################
# dev
####################
FROM prod AS dev

####################
# xdebug
####################
RUN pecl install xdebug && docker-php-ext-enable xdebug
