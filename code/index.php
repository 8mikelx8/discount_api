<?php

use Miquel\DiscountApi\Controllers\ProductsController;
use Slim\Factory\AppFactory;

error_reporting(E_ERROR);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/container.php';

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/products', ProductsController::class);

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->run();
