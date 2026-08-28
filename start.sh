#!/bin/bash
set -e

# Railway (and most PaaS providers) inject a PORT env var at runtime.
# Default to 8000 for local/dev usage when PORT isn't set.
export PORT="${PORT:-8000}"

echo "Booting Laravel app..."
echo "Working directory: $(pwd)"

# Create .env from .env.example if it doesn't exist
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate app key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    php artisan key:generate --force
fi

# Make sure the directories Laravel needs actually exist and are writable
mkdir -p bootstrap/cache \
    storage/app \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs
chmod -R 775 bootstrap/cache storage || true

# Cache config (non-fatal if it fails, e.g. missing DB during first boot)
php artisan config:cache || true

# Sanity check that the public/index.php entrypoint exists before we bind
if [ ! -f public/index.php ]; then
    echo "ERROR: public/index.php not found in $(pwd). Aborting." >&2
    exit 1
fi

echo "Starting PHP built-in server on 0.0.0.0:${PORT} (bound to all interfaces, not localhost)..."

# Use exec so the PHP server becomes PID 1 and correctly receives signals
# from the container runtime (needed for graceful shutdown/restarts).
exec php -S 0.0.0.0:"${PORT}" -t public
