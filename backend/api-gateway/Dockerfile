# Usa la imagen oficial de PHP con extensiones necesarias
FROM php:8.3-cli

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    unzip git curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    libbrotli-dev libssl-dev libcurl4-openssl-dev zlib1g-dev pkg-config build-essential \
    && rm -rf /var/lib/apt/lists/*

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala Swoole con las opciones adecuadas
RUN pecl install swoole \
    && docker-php-ext-enable swoole

# Instala la extensión Redis de PHP
RUN pecl install redis \
    && docker-php-ext-enable redis

# Instala extensiones PHP necesarias
RUN docker-php-ext-install pcntl pdo pdo_mysql sockets zip bcmath

# Crea directorio de trabajo
WORKDIR /var/www

# Copia los archivos del proyecto
COPY . .

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Genera la clave de la aplicación
RUN php artisan key:generate

# Exponer el puerto de Laravel Octane
EXPOSE 8000

# Comando de inicio
CMD ["php", "artisan", "octane:start", "--server=swoole", "--host=0.0.0.0", "--port=8000"]
