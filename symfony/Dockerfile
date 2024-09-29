FROM php:8.3
WORKDIR /var/www/

RUN apt-get update && \
    apt-get install -y libicu-dev libpq-dev libzip-dev unzip git && \
    docker-php-ext-install intl pdo pdo_pgsql zip && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug
COPY . .

CMD ["php", "-S", "0.0.0.0:80", "-t", "./html", "./html/index.php"]