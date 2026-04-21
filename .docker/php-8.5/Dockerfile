FROM php:8.5-fpm AS prod

WORKDIR /var/www

####################
# PHP db
####################
RUN docker-php-ext-install pdo pdo_mysql


####################
# composer
####################
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


####################
# dev
####################
FROM prod AS dev

####################
# xdebug
####################
RUN pecl install xdebug && docker-php-ext-enable xdebug
