FROM php:latest

# Installiere benötigte Pakete
RUN apt-get update && apt-get install -y \
    libmaxminddb0 \
    libmaxminddb-dev \
    libgeoip-dev \
    git \
    unzip \
    apache2 \
    && rm -rf /var/lib/apt/lists/*

# Installiere Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installiere GeoIP2 PHP-Erweiterung über Composer
RUN composer require geoip2/geoip2:~2.0

# Kopiere GeoIP2-Datenbank
COPY GeoLite2-ASN.mmdb /usr/share/GeoIP/GeoLite2-ASN.mmdb

# Setze Arbeitsverzeichnis
WORKDIR /var/www/html

# Kopiere PHP-Skript
COPY index.php /var/www/html/index.php
COPY config.php /var/www/html/config.php
COPY GeoLite2-ASN.mmdb /var/www/html/GeoLite2-ASN.mmdb

# Konfiguriere Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Exponiere Port (falls erforderlich)
EXPOSE 80

# Start Apache im Vordergrund
CMD ["apachectl", "-D", "FOREGROUND"]
