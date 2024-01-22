FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    apt-utils \
    rpm \
    aptitude

RUN apt-get install -y \
        libpq-dev \
        git \
        zip \
        libpng-dev \
        zlib1g-dev \
        libzip-dev \
        libxslt1-dev \
    && docker-php-ext-install -j$(nproc) pgsql \
    && docker-php-ext-install -j$(nproc) pdo_pgsql \
    && docker-php-ext-install -j$(nproc) bcmath \
    && docker-php-ext-install -j$(nproc) opcache \
    && docker-php-ext-install -j$(nproc) xsl \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-install -j$(nproc) intl \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY ./test/ /var/www/html

RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

COPY ./docker/php-fpm/conf/php-cli.ini /etc/php/conf.d/php-cli.ini
COPY ./docker/php-fpm/conf/php-fpm.ini /etc/php/conf.d/php-fpm.ini
COPY ./docker/php-fpm/conf/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN curl -sS https://getcomposer.org/installer | php \
&& mv composer.phar /usr/local/bin/composer

COPY ./docker/php-fpm/run.sh /tmp
RUN chmod -R 777 /tmp/run.sh

ENTRYPOINT ["/tmp/run.sh"]

EXPOSE 9000
