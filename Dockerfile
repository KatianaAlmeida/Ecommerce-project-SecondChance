FROM php:8.2-cli

# Install PostgreSQL libraries
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Expose Render port
EXPOSE 10000

# Start PHP server
CMD ["sh", "-c", "php -S 0.0.0.0:$PORT"]