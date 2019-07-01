<?php

namespace Core;


use Core\Interfaces\AppInterface;
use Core\Interfaces\RouterInterface;

class MicroApp implements AppInterface
{

    /** @var RouterInterface */
    private $router;

    /** @var array */
    private $config;

    public function __construct(RouterInterface $router)
    {
        global $config;
        $this->config = $config;
        $this->router = $router;
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function handle(): void
    {
        $this->router->handle(new Request());
    }

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function GET(string $path, array $handler): void
    {
        $this->router->addRoute($path, Request::METHOD_GET, $handler);
    }

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function POST(string $path, array $handler): void
    {
        $this->router->addRoute($path, Request::METHOD_POST, $handler);
    }

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function PUT(string $path, array $handler): void
    {
        $this->router->addRoute($path, Request::METHOD_PUT, $handler);
    }

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function DELETE(string $path, array $handler): void
    {
        $this->router->addRoute($path, Request::METHOD_DELETE, $handler);
    }

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function PATCH(string $path, array $handler): void
    {
        $this->router->addRoute($path, Request::METHOD_PATCH, $handler);
    }

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function HEAD(string $path, array $handler): void
    {
        $this->router->addRoute($path, Request::METHOD_HEAD, $handler);
    }

}