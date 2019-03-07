#!/usr/bin/env bash

composer install

PATH=$PATH:/var/www/html/vendor/bin

exec apache2-foreground

