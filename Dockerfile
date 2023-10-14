FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www/html/root

# Install dependencies
RUN apt-get update && apt-get install -y \
  libzip-dev \
  libonig-dev \
  build-essential \
  default-mysql-client \
  libpng-dev \
  libjpeg62-turbo-dev \
  libfreetype6-dev \
  locales \
  zip \
  supervisor \
  jpegoptim optipng pngquant gifsicle \
  vim \
  unzip \
  git \
  curl \
  openssl \
  libxml2-dev

RUN apt-get install -y libc-client-dev libkrb5-dev

# Install extensions
RUN docker-php-ext-install gd pdo_mysql xml zip
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
  && docker-php-ext-install imap \
  && docker-php-ext-enable imap
RUN pecl install redis && docker-php-ext-enable redis

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/html/root

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/html/root
RUN chmod 775 storage bootstrap -R

# Generate optimized autoloader
# ENV COMPOSER_ALLOW_SUPERUSER=1
# RUN composer install
# RUN composer dump-autoload --optimize

# Expose port 9000 and start php-fpm server
EXPOSE 9000

WORKDIR /var/www
CMD ["php-fpm"]
