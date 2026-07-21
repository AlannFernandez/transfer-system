FROM php:8.3-fpm

# 1. Instalar dependencias del sistema operativo
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# 2. Limpiar la caché de apt para mantener la imagen ligera
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Instalar extensiones de PHP necesarias para Laravel y el sistema financiero
# Nota: 'bcmath' es fundamental para cálculos matemáticos con precisión decimal sin errores de flotantes
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 4. Instalar y habilitar la extensión de Redis mediante PECL
RUN pecl install redis && docker-php-ext-enable redis

# 5. Copiar Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Definir el directorio de trabajo predeterminado dentro del contenedor
WORKDIR /var/www/api

EXPOSE 9000
CMD ["php-fpm"]