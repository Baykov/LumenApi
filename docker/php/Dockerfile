FROM php:7.4-fpm

WORKDIR /app
#RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN apt update
RUN apt install -y wget netcat zip
# Install Postgre PDO
#RUN docker-php-ext-install pdo pdo_pgsql pgsql && docker-php-ext-enable pdo_pgsql
# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-enable pdo_pgsql

# Install imagick
RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*
RUN printf "\n" | pecl install imagick
RUN docker-php-ext-enable imagick

#install ZIP for composer
RUN apt-get update && apt-get install -y libzip-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

#RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Install Xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find $(php-config --extension-dir) -name xdebug.so)" \
         > /usr/local/etc/php/conf.d/xdebug.ini

#RUN wget -O composer-setup.php https://getcomposer.org/installer
#RUN php composer-setup.php --filename=composer.phar
#RUN php composer.phar install
#RUN chmod +x /app/bin/console
##RUN mkdir -p /app/var/log
#RUN touch /app/var/log/dev.log
#RUN mkdir -p /app/var/cache
#RUN chmod +x /app/docker/php/entrypoint.sh
CMD ["php-fpm", "-F"]