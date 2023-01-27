FROM php:8.1-apache
COPY ./ /var/www/html/
WORKDIR /var/www/html
RUN a2enmod headers
RUN service apache2 restart
COPY .htaccess /var/www/html/.htaccess
RUN docker-php-ext-install pdo pdo_mysql

