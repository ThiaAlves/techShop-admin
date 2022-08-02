FROM php:8.1-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

COPY . .

# USER $user
USER root

RUN composer update

RUN php artisan key:generate

RUN chown -R techshop:techshop /var/www
RUN chmod +777 storage/logs/laravel.log
RUN chmod +777 storage/framework/cache/
RUN chmod +777 storage/framework/sessions/
RUN chmod +777 storage/framework/cache/data
RUN php artisan cache:clear


#RUN php artisan migrate --seed

