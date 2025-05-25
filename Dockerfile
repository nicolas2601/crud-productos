FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    nodejs \
    npm \
    nginx

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Obtener Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear y configurar directorios
RUN mkdir -p /var/www/public /run/nginx
WORKDIR /var/www

# Configurar Nginx
COPY docker/nginx/app.conf /etc/nginx/conf.d/default.conf

# Copiar código de la aplicación
COPY --chown=www-data:www-data . /var/www/

# Establecer permisos
RUN chown -R www-data:www-data /var/www /var/lib/nginx /run/nginx

# Instalar dependencias como www-data
USER www-data
RUN composer install --no-interaction --no-dev --optimize-autoloader
RUN npm install && npm run build

# Volver a root para el comando final
USER root

# Exponer puerto 80 y ejecutar Nginx y PHP-FPM
EXPOSE 80
CMD sh -c "nginx && php-fpm"