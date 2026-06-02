# ==============================================================================
# STAGE 1: Kompilasi Aset Frontend (Menggunakan Node.js 22 & Bun Terbaru)
# ==============================================================================
FROM --platform=linux/amd64 oven/bun:1.1-slim AS frontend-builder
WORKDIR /build

# Copy file package untuk memanfaatkan cache layer
COPY package.json bun.lockb* package-lock.json* ./

# Kita pakai Bun untuk install dan build agar cepat dan kompatibel dengan Node 22 bawaan Bun
RUN bun install --frozen-lockfile

# Copy seluruh source code proyek Sasprasin
COPY . .

# Jalankan build CSS/JS Vite
RUN bun run build

# ==============================================================================
# STAGE 2: Runtime Aplikasi (PHP CLI 8.3)
# ==============================================================================
FROM --platform=linux/amd64 php:8.3-cli AS runner
WORKDIR /app

# 1. Install dependensi OS dasar & Ekstensi PHP untuk Laravel + Excel (GD & Zip)
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip4 libpng16-16 libjpeg62-turbo libfreetype6 unzip git \
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) zip gd pdo pdo_mysql \
    && pecl install redis && docker-php-ext-enable redis \
    && apt-get purge -y --auto-remove libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# 2. Ambil Composer versi resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Copy file composer untuk install vendor PHP
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-dev --prefer-dist --no-scripts \
    && rm -rf ~/.composer/cache

# 4. Copy seluruh kode aplikasi Laravel ke dalam container
COPY --chown=www-data:www-data . /app

# 5. Salin HASIL BUILD VITE dari STAGE 1 ke folder public Laravel
COPY --from=frontend-builder --chown=www-data:www-data /build/public/build ./public/build

# 6. Jalankan optimasi Laravel (Menggunakan Dummy Key agar tidak error $2025 saat build)
RUN APP_ENV=local APP_KEY=base64:dGhpcy1pcy1hLWR1bW15LWtleS1mb3RetWlkaW5nLW9ubHk= \
    php artisan storage:link \
    && php artisan optimize

# 7. Set permission storage
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Buka port 8000
EXPOSE 8000

# 8. Jalankan menggunakan perintah artisan serve sesuai request Anda
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]