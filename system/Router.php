<?php

class Router
{
    private array $routes = [];

    public function addRoute(string $path, array $rules): void
    {
        $this->routes[$path] = $rules;
    }

    public function processRoute(string $url, string $method): void {
        $routes = $this->routes;
        if (!$routes) {
            throw new Exception('No routes found');
        }

        $controllerAction = $routes[$url][$method] ?? null;

        if(!$controllerAction) {
            Response::error404();
        }

        $this->dispatch($controllerAction);
    }

    private function dispatch(string $controllerAction): void {
        [$controller, $action] = explode('@', $controllerAction);
        if(!isset($controller, $action)) {
            throw new Exception('Controller and action are required for this route');
        }

        $fileName = CONTROLLERS_DIR . $controller . '.php';
        if(!file_exists($fileName)) {
            throw new Exception('Controller file not found');
        }

        require_once $fileName;

        $controllerObject = new $controller();
        $controllerObject->$action();
    }
}