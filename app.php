<?php

use App\Models\Product;
use Core\App;
use Core\Container;
use Core\Database;

$config = require_once BASE_PATH . '/config.php';

$container = new Container();
$container->bind('Database', function () use ($config) {
    return Database::getInstance($config);
});

$container->bind('Product', function () use ($container) {
    return new Product($container->resolve('Database'));
});

App::setContainer($container);