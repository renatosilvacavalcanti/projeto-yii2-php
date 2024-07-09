FROM php:7.1-apache

# Instalar dependências
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql


# Instale Xdebug 2.9.8
RUN pecl install xdebug-2.9.8 \
    && docker-php-ext-enable xdebug

# Copiar arquivos do projeto
COPY . /var/www/html

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
# Configurar o Apache para usar o diretório web
RUN echo "DocumentRoot /var/www/html/web" > /etc/apache2/sites-available/000-default.conf
RUN echo "<Directory /var/www/html/web>" >> /etc/apache2/sites-available/000-default.conf
RUN echo "    Options Indexes FollowSymLinks" >> /etc/apache2/sites-available/000-default.conf
RUN echo "    AllowOverride All" >> /etc/apache2/sites-available/000-default.conf
RUN echo "    Require all granted" >> /etc/apache2/sites-available/000-default.conf
RUN echo "</Directory>" >> /etc/apache2/sites-available/000-default.conf

# Habilitar o módulo rewrite do Apache
RUN a2enmod rewrite

# Configure o Xdebug
RUN echo "zend_extension=xdebug.so" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.remote_port=9003" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.remote_log=/var/log/xdebug.log" >> /usr/local/etc/php/php.ini

EXPOSE 80
EXPOSE 9003


