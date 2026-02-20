FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_sqlite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install PHP dependencies (optimized)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build Vite assets
RUN npm install
RUN npm run build

# Prepare SQLite database & set permissions
RUN mkdir -p database \
    && touch database/database.sqlite \
    && chmod -R 775 storage bootstrap/cache database

# Clear old Laravel caches (VERY IMPORTANT)
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Cache config for production (after clearing)
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Expose port for Render
EXPOSE 10000

# Start application
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000