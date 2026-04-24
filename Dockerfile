FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    gnupg \
    && docker-php-ext-install pdo pdo_pgsql

# Install Node 18
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Build frontend
RUN npm install
RUN npm run build

EXPOSE 10000

# Start app (with delay for DB)
CMD sleep 10 && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000