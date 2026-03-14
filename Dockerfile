FROM php:8.2-apache

# Enable Apache mod_rewrite for URL routing
RUN a2enmod rewrite

# Install required PHP extensions (e.g., mysqli, PDO, and MySQL)
RUN docker-php-ext-install mysqli pdo pdo_mysql docker-php-ext-enable mysqli

# Update the default Apache site to use the /public directory as the document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy project files into the container
COPY . /var/www/html

# Set appropriate permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
