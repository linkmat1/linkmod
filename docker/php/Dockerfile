FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
      wget \
      git \
      fish \
      unzip
RUN apt-get update && apt-get install -y libicu-dev
RUN apt-get update && apt-get install -y libzip-dev && docker-php-ext-install pdo zip
RUN apt-get -y update \
&& apt-get install -y libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl
# Support de Postgre
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo_pgsql

# Support de MySQL (pour la migration)
RUN docker-php-ext-install mysqli pdo_mysql
RUN pecl install xdebug-2.8.1 && docker-php-ext-enable xdebug
RUN docker-php-ext-install intl && docker-php-ext-enable intl
# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Symfony tool
RUN wget https://get.symfony.com/cli/installer -O - | bash && \
  mv /root/.symfony/bin/symfony /usr/local/bin/symfony

ADD xdebug.ini /usr/local/etc/php/conf.d/

ARG USER_ID
ARG GROUP_ID

RUN groupadd -f --gid 1000 user
RUN adduser --disabled-password --gecos '' --uid 1000 --gid 1000 user
USER user
WORKDIR /var/www

EXPOSE 9000
