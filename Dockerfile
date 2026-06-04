FROM php:8.2.31-apache

WORKDIR /var/www/html

COPY --chown=www-data:www-data . /var/www/html/
COPY php.ini "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install mysqli pdo pdo_mysql opcache \
    && a2enmod rewrite \
    && chmod -R 755 /var/www/html \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]