FROM php:7.2-fpm

# Install base utils
RUN apt-get update && apt-get install -y apt-utils curl wget git unzip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install php extensions
RUN apt-get install -y \
    libgmp-dev \
    && docker-php-ext-configure gmp && docker-php-ext-install gmp

RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    libpq-dev \
    && docker-php-ext-install -j$(nproc) iconv mbstring pgsql pdo_pgsql

RUN apt-get install -y libzip-dev \
    && docker-php-ext-install zip

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/* \
    && pecl install imagick \
    && docker-php-ext-enable imagick

RUN apt-get update -y && apt-get install -y \
    libsodium-dev \
    && pecl install libsodium

# Management rights
ARG USER_ID=1000
ARG GROUP_ID=1000

RUN if [ ${USER_ID:-0} -ne 0 ] && [ ${GROUP_ID:-0} -ne 0 ]; then \
    userdel -f www-data && \
    if getent group www-data ; then groupdel www-data; fi && \
    groupadd -g ${GROUP_ID} www-data && \
    useradd -l -u ${USER_ID} -g www-data www-data && \
    install -d -m 0755 -o www-data -g www-data /home/www-data && \
    chown --changes --silent --no-dereference --recursive \
          --from=33:33 ${USER_ID}:${GROUP_ID} \
        /home/www-data \
#        /.composer \
#        /var/run/php-fpm \
#        /var/lib/php/sessions \
;fi

RUN usermod -u ${USER_ID} www-data

#USER www-data

CMD ["php-fpm"]
