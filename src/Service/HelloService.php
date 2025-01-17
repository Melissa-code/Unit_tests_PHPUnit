<?php

namespace App\Service;

class HelloService
{
    public function sayHello(string $firstname, ?string $lastname = null): ?string
    {
        return 'Hello ' . $firstname . $lastname . '!';
    }
}