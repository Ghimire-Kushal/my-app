FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    gnupg \
    && docker-php-ext-install pdo pdo_pgsql

# Install Node.js 18 (for Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node + build frontend
RUN npm install
RUN npm run build

# Fix permissions (VERY IMPORTANT for Laravel)
RUN chmod -R 775 storage bootstrap/cache

# Optimize Laravel (safe for production)
RUN php artisan config:clear || true
RUN php artisan cache:clear || true
RUN php artisan config:cache || true
RUN php artisan route:cache || true
RUN php artisan view:cache || true

# Expose port
EXPOSE 10000

# Start server ONLY (no risky commands here)
# CMD php artisan serve --host=0.0.0.0 --port=10000
CMD sleep 15 && php artisan config:clear && php artisan cache:clear && php artisan migrate --force || true && php artisan serve --host=0.0.0.0 --port=10000