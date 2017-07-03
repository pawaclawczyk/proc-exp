FROM php:7.0-zts

RUN apt-get update \
    && apt-get install htop

RUN docker-php-ext-install -j$(nproc) opcache

RUN pecl install ev \
    && pecl install pthreads \
    && docker-php-ext-enable ev pthreads


CMD ["/bin/bash"]
