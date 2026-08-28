#!/bin/bash
set -e

# Create .env from .env.example if it doesn't exist
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate app key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    php artisan key:generate --force
fi

# Cache config
php artisan config:cache || true

# Start PHP server
php -S 0.0.0.0:8000 -t public

