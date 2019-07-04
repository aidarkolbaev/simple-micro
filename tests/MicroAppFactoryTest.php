<?php

use PHPUnit\Framework\TestCase;

class MicroAppFactoryTest extends TestCase
{
    public function testMicroAppCreation() {
        $appFactory = new \Core\MicroAppFactory();
        $app = $appFactory->createApp();
        $this->assertInstanceOf(\Core\MicroApp::class, $app);
    }
}