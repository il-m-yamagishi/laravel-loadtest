CREATE DATABASE IF NOT EXISTS `laravel-01-apache`;
CREATE DATABASE IF NOT EXISTS `laravel-02-fpm`;
CREATE DATABASE IF NOT EXISTS `laravel-03-nginxunit`;
CREATE DATABASE IF NOT EXISTS `laravel-04-rr`;

CREATE USER 'laravel-writer'@'localhost' IDENTIFIED BY 'laravel-writer';
CREATE USER 'laravel-writer'@'%' IDENTIFIED BY 'laravel-writer';
GRANT ALL ON *.* TO 'laravel-writer'@'localhost';
GRANT ALL ON *.* TO 'laravel-writer'@'%';

CREATE USER 'exporter'@'localhost' IDENTIFIED BY 'secret';
CREATE USER 'exporter'@'%' IDENTIFIED BY 'secret';
GRANT PROCESS, REPLICATION CLIENT, SELECT ON *.* TO 'exporter'@'localhost';
GRANT PROCESS, REPLICATION CLIENT, SELECT ON *.* TO 'exporter'@'%';

FLUSH PRIVILEGES;
