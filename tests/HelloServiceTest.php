<?php

namespace Tests;

use App\Service\HelloService;
use PHPUnit\Framework\TestCase;

class HelloServiceTest extends TestCase
{
    public function testHelloWithName()
    {
        $helloService = new HelloService();
        $this->assertSame('Hello Sarah!', $helloService->sayHello('Sarah'));
        $this->assertSame('Hello Georges!', $helloService->sayHello('Georges'));
        $this->assertNotSame('Hello Georges!', $helloService->sayHello('Sarah'));
        $this->assertNotSame('Hello John doe!', $helloService->sayHello('John', 'Doe'));
    }
}