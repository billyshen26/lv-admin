FROM php:7.4-fpm

# set timezome
ENV TZ=Asia/Shanghai
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# 使用 阿里源 替换
RUN sed -i "s@http://deb.debian.org@http://mirrors.aliyun.com@g" /etc/apt/sources.list
# 替换似乎没有成功,待完善
RUN sed -i "s@http://security-cdn.debian.org@http://mirrors.aliyun.com@g" /etc/apt/sources.list

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        zip unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli

RUN pecl install redis-5.1.1 \
    && pecl install xdebug-2.8.1 \
    && docker-php-ext-enable redis xdebug


#
### Install package and PHP Core extensions
#RUN apt-get update && apt-get install -y \
#        git \
#        libfreetype6-dev \
#        libjpeg62-turbo-dev \
#        libpng-dev \
#	&& docker-php-ext-install -j$(nproc) gd \
#        && docker-php-ext-install zip \
#        && docker-php-ext-install pdo_mysql \
#        && docker-php-ext-install opcache \
#        && docker-php-ext-install mysqli \
#        && docker-php-ext-install pcntl \
#        && docker-php-ext-install bcmath \
#        && rm -r /var/lib/apt/lists/*
##
## Copy extensions had downloaded
#COPY ./pkg/redis-5.1.1.tgz /home/redis.tgz
##
## Install PECL extensions (Redis)
#RUN pecl install /home/redis.tgz && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini
#
## Install Phalcon extensions
##RUN cd /home \
##    && tar -zxvf cphalcon.tar.gz \
##    && mv cphalcon-* phalcon \
##    && cd phalcon/build \
##    && ./install \
##    && echo "extension=phalcon.so" > /usr/local/etc/php/conf.d/phalcon.ini
#
# Install Composer
ENV COMPOSER_HOME /root/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV PATH $COMPOSER_HOME/vendor/bin:$PATH
#
##RUN rm -f /home/redis.tgz \
##        rm -f /home/cphalcon.tar.gz
#
#WORKDIR /data
#
## Write Permission
#RUN usermod -u 1000 www-data

#WORKDIR /var/www/html

##更改国内源
#CMD composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ \
#&& chmod -R 777 . \
#&& composer install \
#&& php think migrate:run \
#&& php think seed:run \
#&& echo "脚本执行完成"