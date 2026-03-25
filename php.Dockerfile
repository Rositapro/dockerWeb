FROM php:8.2-fpm

# Instalar extensiones de MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar configuración personalizada
COPY ./php/custom.ini /usr/local/etc/php/conf.d/custom.ini