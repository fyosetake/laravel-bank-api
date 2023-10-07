# Usa a imagem oficial do PHP na versão 8.2
FROM php:8.2-fpm

# Instala as dependências necessárias para o Laravel e o cron
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    cron \
    && docker-php-ext-install zip pdo_mysql

# Instala o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia os arquivos do seu projeto para o contêiner
COPY . /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Expõe a porta 80
EXPOSE 80