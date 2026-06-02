# ==============================================================================
# STAGE 1: Kompilasi Aset Frontend (Bun)
# ==============================================================================
FROM --platform=linux/amd64 oven/bun:1.1-slim AS frontend-builder
WORKDIR /build

COPY package.json bun.lockb* ./
RUN bun install --frozen-lockfile

COPY . .
RUN bun run build

# ==============================================================================
# STAGE 2: Runtime Aplikasi (PHP CLI)
# ==============================================================================
FROM --platform=linux/amd64 php:8.3-cli AS runner
WORKDIR /app

# 1. Install dependensi OS dan ekstensi PHP yang dibutuhkan Laravel & Redis
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip gd pdo pdo_mysql \
    && pecl install redis && docker-php-ext-enable redis \
    && apt-get purge -y --auto-remove libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# 2. Ambil Composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Copy file composer untuk caching layer
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-dev --prefer-dist --no-scripts \
    && rm -rf ~/.composer/cache

# 4. Copy seluruh kode aplikasi Laravel ke dalam container
COPY --chown=www-data:www-data . /app

# 5. Copy hasil kompilasi aset (Vite) dari STAGE 1
COPY --from=frontend-builder --chown=www-data:www-data /build/public/build ./public/build

# 6. Jalankan optimasi Laravel dengan key dummy agar tidak error saat build
RUN APP_ENV=local APP_KEY=base64:dGhpcy1pcy1hLWR1bW15LWtleS1mb3RetWlkaW5nLW9ubHk= \
    php artisan storage:link \
    && php artisan optimize

# 7. Set permission untuk folder storage dan cache
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Buka port 8000 sesuai instruksi
EXPOSE 8000

# 8. Jalankan aplikasi menggunakan php artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]