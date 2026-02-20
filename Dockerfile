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

WORKDIR /app

COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies
RUN npm install

# Build frontend assets (Vite)
RUN npm run build

# Prepare SQLite & permissions
RUN mkdir -p database \
    && touch database/database.sqlite \
    && chmod -R 777 database storage bootstrap/cache

EXPOSE 10000

CMD php artisan migrate --force && php -S 0.0.0.0:10000 -t public