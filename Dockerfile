FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    libzip-dev \
    zip \
    gnupg \
    && docker-php-ext-install pdo pdo_pgsql zip

# Enable Apache rewrite
RUN a2enmod rewrite

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Build frontend
RUN npm install && npm run build

# Set correct Apache root
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Permissions (important)
RUN chmod -R 777 storage bootstrap/cache

# Expose port
EXPOSE 10000

# Start script
CMD rm -rf bootstrap/cache/* && \
    php artisan config:clear && \
    php artisan cache:clear && \
    php artisan config:cache && \
    php artisan migrate --force || true && \
    apache2-foreground