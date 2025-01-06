# Используем официальный PHP образ с поддержкой Nginx
FROM php:8.1-fpm

# Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Устанавливаем Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Копируем файлы проекта в контейнер
COPY . .

# Устанавливаем зависимости Laravel
RUN composer install --no-interaction

# Настроим правильные права доступа для папок
RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
