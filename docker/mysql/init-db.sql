CREATE DATABASE IF NOT EXISTS `laravel_prefork`;
CREATE DATABASE IF NOT EXISTS `laravel_event`;
CREATE DATABASE IF NOT EXISTS `laravel_nginx`;
CREATE DATABASE IF NOT EXISTS `laravel_nginxunit`;
CREATE DATABASE IF NOT EXISTS `laravel_roadrunner`;

CREATE USER 'laravel-writer'@'localhost' IDENTIFIED BY 'laravel-writer';
CREATE USER 'laravel-writer'@'%' IDENTIFIED BY 'laravel-writer';
GRANT ALL ON *.* TO 'laravel-writer'@'localhost';
GRANT ALL ON *.* TO 'laravel-writer'@'%';

CREATE USER 'exporter'@'localhost' IDENTIFIED BY 'secret';
CREATE USER 'exporter'@'%' IDENTIFIED BY 'secret';
GRANT PROCESS, REPLICATION CLIENT, SELECT ON *.* TO 'exporter'@'localhost';
GRANT PROCESS, REPLICATION CLIENT, SELECT ON *.* TO 'exporter'@'%';

FLUSH PRIVILEGES;
