<?php
#Router.php
declare(strict_types=1);

namespace Framework;

Class Router {
    private array $routes = [];

    public function add(string $method, string $path, array $controller) {
        $this->routes[] = [
            'path' => $this->normalizePath($path),
            'method' => strtoupper($method),
            'controller' => $controller
        ];
    }

    private function normalizePath(string $path) {
        $path = trim($path, "/");
        $path = "/{$path}/";

        $path = preg_replace('#[/]{2,}#', '/', $path);

        return $path;
    }

    public function dispatch(string $path, string $method) {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        echo $path . $method;
    }
}