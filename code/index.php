<?php

use Miquel\DiscountApi\Controllers\ProductsController;
use Slim\Factory\AppFactory;

error_reporting(E_ERROR);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/container.php';

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/products', ProductsController::class);

$app->run();
