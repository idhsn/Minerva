<?php
session_start();


// Autoloading classes (simplified for now as we don't have composer auto-generated yet)
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Core\Router;

$router = new Router();
$routes = require_once __DIR__ . '/../config/routes.php';
$routes($router);

$url = $_GET['url'] ?? '/';
$router->dispatch($url);
