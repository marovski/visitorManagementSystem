FROM php:7.4-apache

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
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files first for better layer caching
COPY composer.json composer.lock ./

ENV COMPOSER_MEMORY_LIMIT=-1

RUN composer install --no-dev --no-scripts --no-autoloader --no-interaction --ignore-platform-reqs

# Copy rest of application
COPY . .

RUN composer dump-autoload --no-scripts --optimize --ignore-platform-reqs

# Clear any stale bootstrap cache and set permissions
RUN php -r "foreach(glob('bootstrap/cache/*.php') as \$f) unlink(\$f);" && \
    chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache

# Point Apache DocumentRoot at Laravel's public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Apache vhost config to allow .htaccess and enable rewrites
RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Make Apache listen on $PORT (Railway sets this dynamically)
COPY docker-entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8080

CMD ["/entrypoint.sh"]
