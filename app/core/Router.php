<?php

namespace App\Core;

class Router
{
    private $routes = [];

    public function get($path, $action)
    {
        $this->routes['GET'][$path] = $action;
    }

    public function post($path, $action)
    {
        $this->routes['POST'][$path] = $action;
    }

    public function dispatch($uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);
        $path = '/' . ltrim($path, '/');
        $method = $_SERVER['REQUEST_METHOD'];
        $action = $this->routes[$method][$path] ?? null;

        if (!$action) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        $controllerName = "App\\Controllers\\" . $action[0];
        $methodName = $action[1];

        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            $controller->$methodName();
        } else {
            die("Controller $controllerName not found");
        }
    }
}
