FROM php:8.0.1-fpm-buster

WORKDIR /var/www

RUN apt-get update && apt-get install -y locales

RUN pecl install apcu redis xdebug

RUN docker-php-ext-install pdo pdo_mysql pcntl opcache
RUN docker-php-ext-enable pdo pdo_mysql pcntl apcu redis xdebug

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

#RUN apt-get install -y git \
#    && git clone https://github.com/arnaud-lb/php-rdkafka.git \#    && cd php-rdkafka \
#    && phpize \
#    && ./configure \
#    && make all -j 5 \
#    && make install \
#    && echo "extension=rdkafka.so" > /usr/local/etc/php/conf.d/rdkaka.ini \
#    && cd .. \
#    && rm -rf php-rdkafka \
#    && apt-get purge -y git \
#    && apt-get autoremove -y

# Add UID '1000' to www-data
RUN groupmod -o -g 1000 www-data && \
    usermod -o -u 1000 -g www-data www-data

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

USER www-data
