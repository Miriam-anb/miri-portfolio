FROM composer:latest AS builder

COPY composer.json ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --no-scripts

FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY --from=builder /app/vendor ./vendor
COPY . .

# Fix permissions
RUN mkdir -p bootstrap/cache storage \
    && chmod -R 775 bootstrap/cache storage \
    && chown -R www-data:www-data /app

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

