<?php

namespace App\Router {

    class Router
    {
        private $routes;

        public function __construct()
        {
            $this->routes = [];
        }

        /**
         * Add a route to the router.
         *
         * @param string $path
         * @param string $method
         * @param string $action
         */
        public function addRoute(string $path, string $method, string $action)
        {
            $this->routes[] = [
                'path' => $path,
                'method' => $method,
                'action' => $action,
            ];
        }

        /**
         * Match the current request to a route and return the corresponding action.
         *
         * @param string $requestPath
         * @param string $requestMethod
         * @return string|null
         */
        public function matchRoute(string $requestPath, string $requestMethod): ?string
        {
            foreach ($this->routes as $route) {
                if ($route['path'] === $requestPath && $route['method'] === $requestMethod) {
                    return $route['action'];
                }
            }
            return null; // No matching route found
        }
    }
}
