<?php

use PHPUnit\Framework\TestCase;

class JsonResponseTest extends TestCase
{
    public function testInstanceOfResponseInterface() {
        $response = new \Core\JsonResponse();
        $this->assertInstanceOf(\Core\Interfaces\ResponseInterface::class, $response);
    }
}