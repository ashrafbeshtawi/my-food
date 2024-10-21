FROM php:8.3
WORKDIR /var/www/

# Install system dependencies
RUN apt-get update && \
    apt-get install -y libicu-dev libpq-dev libzip-dev unzip git

# Install PHP extensions
RUN docker-php-ext-install intl pdo pdo_pgsql zip && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Copy application files
COPY . .

## install dependencies
RUN composer install

# Set the command to run the PHP built-in server
CMD ["php", "-S", "0.0.0.0:80", "-t", "./html", "./html/index.php"]