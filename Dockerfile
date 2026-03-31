FROM php:7.4-cli

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        mbstring \
        tokenizer \
        xml \
        gd \
        zip \
        bcmath \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

ENV COMPOSER_MEMORY_LIMIT=-1

RUN composer install --no-dev --no-scripts --no-autoloader --no-interaction --ignore-platform-reqs \
    && composer dump-autoload --no-scripts --optimize --ignore-platform-reqs

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD php artisan optimize && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
