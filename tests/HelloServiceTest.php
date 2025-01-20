<?php

namespace Tests;

use App\Service\HelloService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HelloServiceTest extends TestCase
{
    public static function sayHelloProvider(): array
    {
        return [
            ['Georges', null, 'Hello Georges!', true],
            ['Sarah', null, 'Hello Sarah!'],
            ['Sarah', 'Miller', 'Hello Sarah Miller!'],
            ['Georges', 'Miller', 'Hello John Doe!', false],
            ['Sarah', 'Dupont', 'Hello Bernard Dupont!', false],
        ];
    }

    #[DataProvider('sayHelloProvider')]
    public function testSayHello(string $firstname, ?string $lastname, string $excepted, bool $isSame = true)
    {
        $helloService = new HelloService();
        $method = $isSame ? 'assertSame' : 'assertNotSame';

        $this->$method($excepted, $helloService->sayHello($firstname, $lastname));
        //$this->assertSame('Hello Sarah!', $helloService->sayHello('Sarah'));
        //$this->assertSame('Hello Georges!', $helloService->sayHello('Georges'));

        //$this->assertNotSame('Hello Georges!', $helloService->sayHello('Sarah'));
        //$this->assertNotSame('Hello John doe!', $helloService->sayHello('John', 'Doe'));
    }
}