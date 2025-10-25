# Gunakan base image PHP
FROM php:8.2-fpm

# Install dependencies Laravel
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Tentukan working directory di container
WORKDIR /var/www

# Copy semua file project ke dalam container
COPY . .

# Jalankan composer install
RUN composer install --optimize-autoloader

# Beri izin ke folder storage dan bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

# Jalankan aplikasi Laravel pakai artisan
CMD php artisan serve --host=0.0.0.0 --port=8000
