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
    npm

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Obtener Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar código de la aplicación
COPY . /var/www/

# Establecer permisos de directorio
RUN chown -R www-data:www-data /var/www

# Instalar dependencias de Composer
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Instalar dependencias de Node.js y compilar assets
RUN npm install && npm run build

# Instalar y configurar Nginx
RUN apt-get update && apt-get install -y nginx
COPY docker/nginx/app.conf /etc/nginx/conf.d/default.conf

# Exponer puerto 80 y ejecutar Nginx y PHP-FPM
EXPOSE 80
CMD sh -c "service nginx start && php-fpm"