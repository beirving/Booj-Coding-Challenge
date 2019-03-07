#!/usr/bin/env bash

docker network create test-network

#create volume for database
docker volume create testvolume

docker rm -f test
docker run --name=test \
    -v /${PWD}/../source/://var/www/html/ \
    --network=test-network \
    -p 80:80 \
    -d test:latest

docker rm -f mysql
docker run --name="mysql" \
    --network=test-network \
    -e MYSQL_ROOT_PASSWORD=password \
    -p 3306:3306 \
    -v testvolume:/var/lib/mysql \
    -d mysql:5.7.17