FROM php:8.0.27-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN apt-get update && \
    apt-get -y install unzip && \
    apt-get -y autoremove && \
    apt-get -y autoclean && \
    apt-get -y clean

RUN a2enmod rewrite
RUN pecl install apcu-5.1.17 && \
    docker-php-ext-enable \
        opcache \
        apcu

COPY --from=composer:2.5.1 /usr/bin/composer /usr/bin/composer

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
ENV COMPOSER_HOME /var/www/.composer
RUN mkdir -p /var/www/.composer && \
    chown -R www-data /var/www/.composer
