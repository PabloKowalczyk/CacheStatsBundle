FROM php:8.1.29-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf && \
    apt update && \
    apt -y install unzip && \
    apt -y autoremove && \
    apt -y autoclean && \
    apt -y clean && \
    a2enmod rewrite && \
    pecl install apcu-5.1.23 && \
    docker-php-ext-enable \
        opcache \
        apcu

COPY --from=composer:2.7.7 /usr/bin/composer /usr/bin/composer

ENV COMPOSER_HOME /var/www/.composer
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data && \
    mkdir -p /var/www/.composer && \
    chown -R www-data /var/www/.composer
