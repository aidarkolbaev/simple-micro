<?php

namespace Core\Router;


use Core\Request\RequestInterface;

interface RouterInterface
{
    /** @return array */
    public function getRoutes(): array;

    /**
     * @param string $path
     * @param string $method
     * @param array $handler
     * @return void
     */
    public function addRoute(string $path, string $method, array $handler): void;

    /**
     * @param RequestInterface $request
     * @return void
     */
    public function handle(RequestInterface $request): void;
}