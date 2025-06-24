# Use PHP 8.1 with Apache
FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    wkhtmltopdf \
    xvfb \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    pdo_sqlite \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Copy project files
COPY . /var/www/html/

# Copy Docker environment file
COPY .env.docker /var/www/html/.env

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/storage \
    && chmod -R 777 /var/www/html/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Create SQLite database if it doesn't exist
RUN touch /var/www/html/database/database.sqlite \
    && chown www-data:www-data /var/www/html/database/database.sqlite

# Create wrapper script for wkhtmltopdf to handle headless environment
RUN echo '#!/bin/bash\nxvfb-run -a --server-args="-screen 0, 1024x768x24" wkhtmltopdf "$@"' > /usr/local/bin/wkhtmltopdf-wrapper \
    && chmod +x /usr/local/bin/wkhtmltopdf-wrapper

# Set environment variables
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV WKHTMLTOPDF_CMD=/usr/local/bin/wkhtmltopdf-wrapper

# Expose port 80
EXPOSE 80

# Make entrypoint script executable
RUN chmod +x /var/www/html/docker-entrypoint.sh

# Start the application
CMD ["/var/www/html/docker-entrypoint.sh"]

