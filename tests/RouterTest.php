<?php

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function testInstanceOfRouterInterface()
    {
        $router = new \Core\Router();
        $this->assertInstanceOf(\Core\Interfaces\RouterInterface::class, $router, "Router doesn't implement RouterInterface");
    }

    public function testAddingRoutes()
    {
        $router = new \Core\Router();
        $router->addRoute('/test', \Core\Request::METHOD_POST, [
            'controller' => 'Index', 'action' => 'testCreate']);
        $router->addRoute('/test/{name: [a-z]+}', \Core\Request::METHOD_POST, [
            'controller' => 'Index', 'action' => 'testByName']);
        $router->addRoute('/test', \Core\Request::METHOD_GET, [
            'controller' => 'Index', 'action' => 'testGet']);
        $routes = $router->getRoutes();
        $this->assertIsArray($routes, "Routes are not an array");
        $this->assertArrayHasKey(\Core\Request::METHOD_GET, $routes, "Router doesn't have \"GET\" key");
        $this->assertArrayHasKey(\Core\Request::METHOD_POST, $routes, "Router doesn't have \"POST\" key");
    }

    public function testMatchingRoutes()
    {
        $router = new \Core\Router();

        $router->addRoute('/user/{id: \d+}', \Core\Request::METHOD_GET, [
            'controller' => 'test',
            'action' => 'test'
        ]);
        $router->addRoute('/{lastname: [a-z-]+}/{firstname: [a-z]+}', \Core\Request::METHOD_POST, [
            'controller' => 'test',
            'action' => 'test'
        ]);

        $correctRoutes = [
            \Core\Request::METHOD_GET => [
                '/user/9',
                '/user/312',
                '/user/2312312312'
            ],
            \Core\Request::METHOD_POST => [
                '/ronaldo/cristiano',
                '/messi/lionel',
                '/kevin-prince/boateng'
            ]
        ];

        foreach ($correctRoutes as $method => $routes) {
            foreach ($routes as $route) {
                $this->assertTrue($router->match($method, $route), $route);
            }
        }

        $incorrectRoutes = [
            \Core\Request::METHOD_GET => [
                '/user/asd',
                '/users/123',
                '/user/92a',
                '/user/'
            ],
            \Core\Request::METHOD_POST => [
                '/boateng/kevin-prince',
                '/cr/7',
                '/10/messi'
            ]
        ];

        foreach ($incorrectRoutes as $method => $routes) {
            foreach ($routes as $route) {
                $this->assertFalse($router->match($method, $route));
            }
        }
    }
}