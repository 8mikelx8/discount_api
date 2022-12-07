<?php
use Doctrine\DBAL\Connection;
$container = new DI\Container();

$container->set(Connection::class, function($container) {
    $connectionParams = [
        'dbname' => 'discount_api',
        'user' => 'MYSQL_USER',
        'password' => 'MYSQL_PASSWORD',
        'host' => 'mysql',
        'driver' => 'pdo_mysql',
    ];
    return \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
});
