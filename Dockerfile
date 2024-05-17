#FROM php:latest
FROM php:8-apache-buster

# Installiere benötigte Pakete
RUN apt-get update && apt-get install -y \
    libmaxminddb0 \
    libmaxminddb-dev \
    libgeoip-dev \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Installiere Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installiere GeoIP2 PHP-Erweiterung über Composer
RUN composer require geoip2/geoip2:~2.0

# Kopiere GeoIP2-Datenbank
COPY GeoLite2-Country.mmdb /usr/share/GeoIP/GeoLite2-Country.mmdb

# Setze Arbeitsverzeichnis
WORKDIR /var/www/html

# Kopiere PHP-Skript
COPY index.php /var/www/html/index.php
COPY GeoLite2-Country.mmdb /var/www/html/GeoLite2-Country.mmdb

# Exponiere Port (falls erforderlich)
EXPOSE 80
