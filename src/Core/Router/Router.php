<?php

namespace Core\Router;

use Core\Request\RequestInterface;

class Router implements RouterInterface
{
    /** @var array */
    private $routes;

    /** @var array */
    private $params = [];

    /** @var array */
    private $handler;

    /**
     * @param string $method
     * @param string $uri
     * @return bool
     */
    private function match(string $method, string $uri): bool
    {
        foreach ($this->routes[$method] as $path => $handler) {
            if (preg_match($path, $uri, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $this->params[$key] = $match;
                    }
                }
                $this->handler = $handler;
                return true;
            }
        }
        return false;
    }

    /** @return array */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param string $path
     * @param string $method
     * @param array $handler
     * @return void
     */
    public function addRoute(string $path, string $method, array $handler): void
    {
        $path = preg_replace('/\//', '\\/', $path);
        $path = preg_replace('/\{([a-z-_]+):\s*(\S+)\}/', '(?<$1>$2)', $path);
        $path = '/^' . $path . '$/i';

        $this->routes[$method][$path] = $handler;
    }

    /** @return void */
    private function notFound(): void
    {
        http_response_code(404);
        echo 'Not Found';
    }

    /**
     * @param RequestInterface $request
     * @return void
     * @throws \Exception
     */
    public function handle(RequestInterface $request): void
    {
        if ($this->match($request->getMethod(), $request->getRequestURI())) {
            $controller = 'Controller\\' . ucfirst($this->handler['controller']) . 'Controller';
            $action = $this->handler['action'] . 'Action';
            if (class_exists($controller) && method_exists($controller, $action)) {
                $controller = new $controller($request);
                call_user_func_array([$controller, $action], $this->params);
            } else {
                throw new \Exception("Undefined method " . $action . " of " . $controller);
            }
        } else {
            $this->notFound();
        }
    }
}