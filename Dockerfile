FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    gnupg \
    && docker-php-ext-install pdo pdo_pgsql

# Install Node 18 (for Laravel + Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build frontend
RUN npm install
RUN npm run build

# Clear and cache config (IMPORTANT)
RUN php artisan config:clear
RUN php artisan cache:clear

# Expose port (Render uses 10000)
EXPOSE 10000

# Start Laravel server (ONLY THIS)
# CMD php artisan serve --host=0.0.0.0 --port=10000
CMD sleep 10 && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000