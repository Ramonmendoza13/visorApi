FROM php:8.2-apache

# Instalar dependencias del sistema, extensiones PHP y habilitar mod_rewrite
# Todo en una sola capa para reducir el tamaño de la imagen
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Obtener Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar DocumentRoot de Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

# Copiar solo los archivos de dependencias primero → mejor aprovechamiento de cache de capas
COPY composer.json composer.lock ./

# Instalar dependencias sin paquetes de desarrollo y con dist (no necesita git)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --no-scripts

# Copiar el resto de la aplicación
COPY . .

# Ejecutar scripts post-install de Composer (package:discover)
RUN composer run-script post-autoload-dump

# APP_KEY requerido para que artisan arranque en el build
# Configurarlo también como Build Variable en el panel de Render
ARG APP_KEY
ENV APP_KEY=${APP_KEY}
# Variables de entorno ficticias para que artisan no falle durante el build
# (route:cache y view:cache no conectan a la BD)
ENV APP_ENV=production
ENV DB_CONNECTION=pgsql
ENV DB_HOST=localhost
ENV DB_DATABASE=placeholder
ENV DB_USERNAME=placeholder
ENV DB_PASSWORD=placeholder

# Cachear rutas y vistas en el build → el arranque no tiene que recalcularlas
RUN php artisan route:cache && php artisan view:cache

# Permisos en una sola capa
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]