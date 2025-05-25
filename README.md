# Gaming Hardware Sales Platform

Una plataforma moderna para la venta de hardware de gaming con una interfaz de usuario atractiva y animaciones fluidas.

## Características

- Diseño moderno con tema de hardware de gaming
- Animaciones y efectos visuales avanzados
- Gestión de productos, fabricantes y clientes
- Control de inventario con entradas y salidas de stock
- Interfaz responsiva para todos los dispositivos

## Requisitos

- PHP 8.1 o superior
- Composer
- Node.js y NPM
- MySQL 8.0

## Instalación Local

1. Clonar el repositorio
   ```bash
   git clone <url-del-repositorio>
   cd Ahora-si-o-si
   ```

2. Instalar dependencias de PHP
   ```bash
   composer install
   ```

3. Instalar dependencias de JavaScript
   ```bash
   npm install
   ```

4. Compilar assets
   ```bash
   npm run build
   ```

5. Configurar el archivo .env
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

6. Configurar la base de datos en el archivo .env

7. Ejecutar migraciones
   ```bash
   php artisan migrate --seed
   ```

8. Iniciar el servidor
   ```bash
   php artisan serve
   ```

## Uso con Docker

### Desarrollo Local con Docker

1. Asegúrate de tener Docker y Docker Compose instalados

2. Configura el archivo .env
   ```bash
   cp .env.example .env
   ```

3. Construye y levanta los contenedores
   ```bash
   docker-compose up -d
   ```

4. Instala dependencias y ejecuta migraciones
   ```bash
   docker-compose exec app composer install
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate --seed
   docker-compose exec app npm install
   docker-compose exec app npm run build
   ```

5. Accede a la aplicación en http://localhost:8000

### Despliegue en Render

Este proyecto está configurado para ser desplegado fácilmente en Render.com utilizando Docker.

1. Crea una cuenta en [Render](https://render.com)

2. Conecta tu repositorio de GitHub

3. Haz clic en "New" y selecciona "Blueprint"

4. Selecciona el repositorio y Render detectará automáticamente el archivo `render.yaml`

5. Configura las variables de entorno necesarias

6. Haz clic en "Apply" para iniciar el despliegue

Render creará automáticamente los servicios definidos en el archivo `render.yaml`, incluyendo la aplicación web y la base de datos MySQL.

## Estructura del Proyecto

- `app/` - Contiene los modelos, controladores y lógica de negocio
- `resources/` - Vistas, assets y archivos de frontend
- `database/` - Migraciones y seeders
- `docker/` - Configuraciones de Docker para desarrollo y producción
- `public/` - Punto de entrada y assets compilados

## Personalización

El tema de gaming hardware se puede personalizar modificando los archivos:

- `tailwind.config.js` - Colores y animaciones
- `resources/views/` - Plantillas Blade
- `resources/css/` - Estilos CSS

## Licencia

Este proyecto está licenciado bajo la Licencia MIT.
