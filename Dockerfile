# Use the PHP Apache image
FROM php:8.2-apache

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli

# Enable Apache mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html
# Copy project files to the web server's document root
# Check the current directory and list files
RUN pwd && ls -la

# Copy project files to the web server's document root
COPY . .


# Set ownership and permissions for the web server
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html  # Ensure proper permissions

# Expose port 80 for the web server
EXPOSE 80

# Start the Apache server in the foreground
CMD ["apache2-foreground"]
