<?php

namespace Tests;

use App\Service\HelloService;
use PHPUnit\Framework\TestCase;

class HelloServiceTest extends TestCase
{
    public function testHelloWithName()
    {
        $helloService = new HelloService();
        $helloSarah = $helloService->sayHello('Sarah');
        $this->assertSame('Hello Sarah!', $helloSarah);
    }
}