# Use official PHP image with Apache
FROM php:8.2-apache

# Enable mod_rewrite if needed
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy PHP file to Apache server root
COPY index.php /var/www/html/

# Set file permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
