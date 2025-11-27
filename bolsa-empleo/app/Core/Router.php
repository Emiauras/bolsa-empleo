<?php
// app/Core/Router.php

namespace App\Core;

use Exception;

class Router
{
    private array $routes = [];
    private Container $container; 

    public function __construct(Container $container) 
    {
        $this->container = $container;
    }

    public function get(string $uri, string $handler): void {
        $this->routes['GET'][$uri] = $handler;
    }
    public function post(string $uri, string $handler): void {
        $this->routes['POST'][$uri] = $handler;
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = strtok($uri, '?');
        $basePath = '/bolsa-empleo/public'; 

        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        $uri = rtrim($uri, '/'); 
        if (empty($uri)) {
            $uri = '/';
        }

        $handler = $this->routes[$method][$uri] ?? null;

        if ($handler === null) {
            $this->handleNotFound($uri, $method);
            return;
        }
        
        $this->callHandler($handler);
    }
    
   // app/Core/Router.php

    private function callHandler(string $handler)
    {
        [$controllerName, $method] = explode('@', $handler);
        $controllerClass = "App\\Controllers\\{$controllerName}"; 
        
        if (!class_exists($controllerClass)) {
            throw new Exception("Controlador no existe: {$controllerClass}", 500);
        }

        $controllerInstance = new $controllerClass($this->container); 

        if (!method_exists($controllerInstance, $method)) {
            throw new Exception("Método no encontrado: {$controllerName}@{$method}", 404);
        }

        $controllerInstance->$method();
    }
    private function handleNotFound(string $uri, string $method): void
    {
        http_response_code(404);
        // Puedes usar la clase View aquí si deseas un 404 más estético
        echo "<h2>Not Found (404)</h2>";
        echo "URI: <b>" . htmlspecialchars($uri) . "</b><br>";
        echo "Method: <b>" . htmlspecialchars($method) . "</b>";
    }
}