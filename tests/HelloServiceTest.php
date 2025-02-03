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

    public static function sayGoodbyeProvider(): array
    {
        return [
            ['Georges', null, 'Au revoir Georges!', true],
            ['Sarah', null, 'Au revoir Sarah!'],
            ['Sarah', 'Miller', 'Au revoir Sarah Miller!'],
            ['Georges', 'Miller', 'Au revoir John Doe!', false],
            ['Sarah', 'Dupont', 'Au revoir Bernard Dupont!', false],
        ];
    }

    #[DataProvider('sayHelloProvider')]
    public function testSayHello(
        string $firstname,
        ?string $lastname,
        string $excepted,
        bool $isSame = true
    ): void {
        $helloService = new HelloService();
        $method = $isSame ? 'assertSame' : 'assertNotSame';

        $this->$method($excepted, $helloService->sayHello($firstname, $lastname));
    }

    #[DataProvider('sayGoodbyeProvider')]
    public function testSayGoodbye(
        string $firstname,
        ?string $lastname,
        string $excepted,
        bool $isSame = true
    ): void {
        $helloService = new HelloService();
        $method = $isSame ? 'assertSame' : 'assertNotSame';

        $this->$method($excepted, $helloService->sayGoodbye($firstname, $lastname));
    }
}