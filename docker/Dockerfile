FROM trafex/php-nginx:latest

# Install composer from the official image
COPY --from=composer /usr/bin/composer /usr/bin/composer

USER root

# Add required php extention
RUN apk add --no-cache --upgrade \
     php85-exif \
     php85-iconv \
     php85-simplexml \
     php85-gd \
     php85-intl \
     php85-pdo \
     php85-pdo_mysql \
     php85-ctype

USER nobody
