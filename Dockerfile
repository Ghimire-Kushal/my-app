FROM php:8.4-apache

# -----------------------------
# Install system dependencies
# -----------------------------
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    libzip-dev \
    zip \
    gnupg \
    && docker-php-ext-install pdo pdo_pgsql zip

# -----------------------------
# Enable Apache rewrite
# -----------------------------
RUN a2enmod rewrite

# -----------------------------
# Install Node.js
# -----------------------------
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# -----------------------------
# Install Composer
# -----------------------------
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# -----------------------------
# Set working directory
# -----------------------------
WORKDIR /var/www/html

# -----------------------------
# Copy project files
# -----------------------------
COPY . .

# -----------------------------
# Install PHP dependencies
# -----------------------------
RUN composer install --no-dev --optimize-autoloader

# -----------------------------
# Build frontend assets
# -----------------------------
RUN npm install && npm run build

# -----------------------------
# Set Apache document root
# -----------------------------
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# -----------------------------
# Create Laravel required folders
# -----------------------------
RUN mkdir -p \
    storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

# -----------------------------
# Fix permissions
# -----------------------------
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache

# -----------------------------
# Apache port (Render compatibility)
# -----------------------------
RUN sed -i 's/80/10000/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 10000

# -----------------------------
# ✅ RUNTIME FIX (IMPORTANT)
# -----------------------------
CMD rm -rf public/storage && \
    php artisan storage:link && \
    php artisan config:clear && \
    php artisan cache:clear && \
    php artisan view:clear && \
    php artisan migrate --force && \
    apache2-foreground