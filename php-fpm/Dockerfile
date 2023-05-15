FROM php:7.2-fpm-alpine

RUN apk update \
    && apk add  --no-cache git curl libmcrypt libmcrypt-dev openssh-client icu-dev \
    libxml2-dev freetype-dev libpng-dev libjpeg-turbo-dev g++ make autoconf \
    && docker-php-source extract \
    && docker-php-source delete \
    && docker-php-ext-install pdo pdo_mysql soap intl zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /tmp/*

ENV ALPINE_MIRROR "http://dl-cdn.alpinelinux.org/alpine"
RUN echo "${ALPINE_MIRROR}/edge/main" >> /etc/apk/repositories
RUN apk add --no-cache nodejs nodejs-npm  --repository="http://dl-cdn.alpinelinux.org/alpine/edge/community"
RUN node --version

RUN npm install -g yarn
RUN yarn install

CMD ["php-fpm", "-F"]

WORKDIR /var/www/website

EXPOSE 9000