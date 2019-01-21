FROM php:7-apache
RUN apt-get update -y && apt-get install -y libpng-dev curl libcurl4-openssl-dev
RUN docker-php-ext-install pdo pdo_mysql gd curl
RUN a2enmod rewrite
RUN service apache2 restart
#docker exec -i challenge_db_1 /usr/bin/mysql -u root --password=neueda neueda_challenge < dump/dump.sql