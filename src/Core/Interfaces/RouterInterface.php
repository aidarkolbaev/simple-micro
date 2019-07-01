<?php

namespace Core\Interfaces;


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
     * @throws \Exception
     */
    public function handle(RequestInterface $request): void;
}