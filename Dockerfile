# Use a imagem oficial do PHP 8.1 como base
FROM php:8.1-fpm

# Instale dependências do Laravel e Supervisor
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    supervisor \
    && docker-php-ext-install zip pdo_mysql

# Copie os arquivos do Laravel para o container
COPY . /var/www/html

# Configure permissões de armazenamento do Laravel
RUN chown -R www-data:www-data /var/www/html/storage

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instale as dependências do Composer
RUN cd /var/www/html && composer install

# Exponha a porta 3000 para o servidor PHP-FPM
EXPOSE 3000

# Comando para iniciar o Supervisor, que executará PHP-FPM e o servidor PHP embutido
CMD ["/usr/bin/supervisord"]
