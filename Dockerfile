FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project files
COPY . .

# Create SQLite database + fix permissions
RUN mkdir -p database \
    && touch database/database.sqlite \
    && chmod -R 777 database \
    && chmod -R 777 storage \
    && chmod -R 777 bootstrap/cache

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port
EXPOSE 10000

# Start Laravel
CMD php -S 0.0.0.0:10000 -t public