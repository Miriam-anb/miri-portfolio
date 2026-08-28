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
    curl \
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

# Railway injects PORT at runtime; default to 8000 so the image also works
# outside of Railway (e.g. local docker run).
ENV PORT=8000
EXPOSE 8000

# Verify the app is actually responding on the bound port, not just that
# the process is running. Uses PORT so it stays correct if Railway
# assigns a different value at runtime.
HEALTHCHECK --interval=10s --timeout=5s --start-period=15s --retries=5 \
    CMD curl -f "http://127.0.0.1:${PORT}/" || exit 1

CMD ["./start.sh"]

