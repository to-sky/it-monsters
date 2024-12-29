<?php

declare(strict_types=1);

namespace Core;

class Router
{
    /**
     * List of all app routes
     * @var array
     */
    protected array $routes = [];

    /**
     * Add a new route to the array of all routes
     * @param $method
     * @param $uri
     * @param $controller
     */
    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    /**
     * Add GET route
     * @param $uri
     * @param $controller
     */
    public function get($uri, $controller)
    {
        $this->add("GET", $uri, $controller);
    }

    /**
     * Add POST route
     * @param $uri
     * @param $controller
     */
    public function post($uri, $controller)
    {
        $this->add("POST", $uri, $controller);
    }

    /**
     * Run controller method
     * @param $uri
     * @param $method
     * @return mixed
     */
    public function route($uri, $method): mixed
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                list($controller, $controllerMethod) = explode('@', $route['controller']);
                $controller = "App\\Controllers\\$controller";

                if (class_exists($controller) && method_exists($controller, $controllerMethod)) {
                    $instance = new $controller();
                    return call_user_func([$instance, $controllerMethod]);
                }
            }
        }

        http_response_code(500);
        echo "Error: Controller or method not found.";
    }
}