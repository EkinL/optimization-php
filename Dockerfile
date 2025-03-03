# Utilisation de PHP 8.4 avec Apache
FROM php:8.4-apache

# Mise à jour des paquets
RUN apt-get update -y && apt-get upgrade -y

# Installation des extensions PHP nécessaires
RUN apt-get install -y zlib1g-dev libwebp-dev libpng-dev && docker-php-ext-install gd
RUN apt-get install -y libzip-dev && docker-php-ext-install zip
RUN apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
RUN apt-get install -y unzip

# Installation et activation d'OPcache
RUN docker-php-ext-install opcache
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Installation de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installation de Node.js 22
RUN curl -fsSL https://deb.nodesource.com/setup_22.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN apt-get install -y nodejs

# Configuration d'Apache
RUN a2enmod rewrite
RUN service apache2 restart

# Exposition du port HTTP
EXPOSE 80