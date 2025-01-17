<?php

namespace App\Service;

class HelloService
{
    public function sayHello(string $name): string
    {
        return 'Hello ' . $name . '!';
    }
}