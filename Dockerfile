FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --no-interaction --prefer-dist

COPY . .

# Fix permissions
RUN mkdir -p bootstrap/cache storage \
    && chmod -R 775 bootstrap/cache storage \
    && chown -R www-data:www-data /app

EXPOSE 8000

CMD ["sh", "-c", "mkdir -p $(dirname \"$DB_DATABASE\") && touch \"$DB_DATABASE\" && php artisan migrate --force && php artisan db:seed --force && (php artisan storage:link || true) && php artisan config:cache && php -S 0.0.0.0:8000 -t public"]
