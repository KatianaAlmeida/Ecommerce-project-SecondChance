# Dockerfile
FROM php:8.2-cli

# Set working directory
WORKDIR /var/www/html

# Copy all files
COPY . .

# Install extensions (if needed, e.g., pgsql for Supabase)
RUN docker-php-ext-install pdo pdo_pgsql pgsql

# Expose port
EXPOSE 5000

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:5000", "-t", "."]