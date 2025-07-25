FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libicu-dev \
    python3 \
    python3-pip \
    python3-venv \
    && docker-php-ext-install pdo_mysql zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-enable intl

RUN a2enmod rewrite

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
 && sed -i 's|<Directory /var/www/html>|<Directory /var/www/html/public>|g' /etc/apache2/apache2.conf \
 && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 🔹 Crear entorno virtual Python y agregarlo al PATH
RUN python3 -m venv /opt/venv
ENV PATH="/opt/venv/bin:$PATH"

# 🔹 Instalar efficient-apriori dentro del entorno virtual
RUN pip install --no-cache-dir efficient-apriori

COPY ./app /var/www/html

WORKDIR /var/www/html

RUN if [ -f "composer.json" ]; then composer install --ignore-platform-req=ext-intl; fi

RUN chown -R www-data:www-data /var/www/html/writable

RUN chmod -R 755 /var/www/html

EXPOSE 80
