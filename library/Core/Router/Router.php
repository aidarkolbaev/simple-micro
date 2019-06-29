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

    /** @var RequestInterface */
    private $request;

    /** @var array */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return bool
     */
    private function match(): bool
    {
        foreach ($this->routes[$this->request->getMethod()] as $path => $handler) {
            if (preg_match($path, $this->request->getRequestURI(), $matches)) {
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
     */
    public function handle(RequestInterface $request): void
    {
        $this->request = $request;
        if ($this->match()) {
            $controller = $this->config['controllerNamespace'] . ucfirst($this->handler['controller']) . 'Controller';
            $controller = new $controller($request);
            $action = $this->handler['action'] . 'Action';
            call_user_func_array([$controller, $action], $this->params);
        } else {
            $this->notFound();
        }
    }
}