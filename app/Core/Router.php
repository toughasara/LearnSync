<?php

namespace App\Core;

class Router{
    
    private $routes = [];

    public function addRoute($method, $path, $controller, $action){
        $this->routes[$method][$path] = [
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch($method, $uri){
        foreach ($this->routes[$method] as $path => $route) {
            if ($path === $uri) {
                $controller = $route['controller'];
                $action = $route['action'];

                $controllerInstance = new $controller();
                $controllerInstance->$action();
                return;
            }
        }

        // Gestion des erreurs 404
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
}