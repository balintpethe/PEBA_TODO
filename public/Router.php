<?php

class Router
{
    private $routes = [];
    private $basePath;

    public function __construct($basePath = '')
    {
        $this->basePath = $basePath;
    }

    public function addRoute($method, $path, $callback)
    {
        $this->routes[] = ['method' => $method, 'path' => $this->basePath . $path, 'callback' => $callback];
    }

    public function dispatch()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['path'] === $requestUri) {
                call_user_func($route['callback']);
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
        exit;
    }
}
