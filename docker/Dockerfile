FROM php:7.2-apache

RUN apt-get update -y --fix-missing;
RUN apt-get upgrade -y;

ENV source /var/www/html/
WORKDIR $source

RUN docker-php-ext-install mbstring
RUN docker-php-ext-install pdo_mysql

RUN curl -s https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN apt-get clean;

ADD apache2.conf /etc/apache2/sites-enabled/000-default.conf
RUN a2enmod rewrite

ADD php.ini /usr/local/etc/php/

ADD bootstrap.sh /var/www/bootstrap.sh
CMD /var/www/bootstrap.sh
