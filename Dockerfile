FROM composer:latest AS builder

COPY composer.json composer.lock* ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --no-scripts \
    --ignore-platform-reqs

FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY --from=builder /app/vendor ./vendor
COPY . .

# Create required directories with proper permissions
RUN mkdir -p bootstrap/cache storage/app storage/framework/cache storage/framework/sessions storage/framework/views storage/logs resources/views \
    && chmod -R 775 bootstrap/cache storage \
    && chown -R www-data:www-data /app \
    && chmod +x start.sh

EXPOSE 8000

CMD ["./start.sh"]

