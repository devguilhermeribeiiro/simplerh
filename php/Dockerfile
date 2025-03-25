FROM php:8.3-fpm

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libpq-dev

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

