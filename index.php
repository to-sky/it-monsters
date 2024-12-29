<?php

require __DIR__ . '/vendor/autoload.php';

const BASE_PATH = __DIR__;

session_start();

require_once 'app.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$router = new Core\Router();
require_once 'routes.php';

try {
    $router->route($uri, $method);
} catch (Exception $e) {
    exit($e->getMessage());
}

session_destroy();
