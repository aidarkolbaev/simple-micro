<?php

namespace Core\Interfaces;


interface RouterInterface
{
    /**
     * @param string $method
     * @param string $uri
     * @return bool
     */
    public function match(string $method, string $uri): bool;

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
     * @throws \Exception
     */
    public function handle(RequestInterface $request): void;
}