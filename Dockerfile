FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p database \
    && touch database/database.sqlite \
    && chmod -R 777 database \
    && chmod -R 777 storage \
    && chmod -R 777 bootstrap/cache

RUN php artisan migrate --force

EXPOSE 10000

CMD php -S 0.0.0.0:10000 -t public