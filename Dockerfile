FROM php:7.4-cli


# Installiere benötigte Pakete
RUN apt-get update && apt-get install -y \
    libmaxminddb0 \
    libmaxminddb-dev \
    libgeoip-dev \
    && rm -rf /var/lib/apt/lists/*

# Installiere GeoIP2 PHP-Erweiterung
RUN pecl install geoip-1.1.1 \
    && docker-php-ext-enable geoip

# Kopiere GeoIP2-Datenbank
COPY GeoLite2-ASN.mmdb /usr/share/GeoIP/GeoLite2-Country.mmdb

# Setze Arbeitsverzeichnis
WORKDIR /var/www/html

# Kopiere PHP-Skript
COPY index.php /var/www/html/index.php
COPY config.php /var/www/html/config.php
COPY GeoLite2-ASN.mmdb /var/www/html/GeoLite2-ASN.mmdb

# Exponiere Port (falls erforderlich)
EXPOSE 80
