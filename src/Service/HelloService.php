<?php

namespace App\Service;

class HelloService
{
    public function sayHello(string $firstname, ?string $lastname = null): ?string
    {
        $sentence = 'Hello ' . $firstname;
        if ($lastname) {
            $sentence .= ' ' . $lastname;
        }

        return $sentence . '!';
    }

    public function sayGoodbye(string $firstname, ?string $lastname = null): ?string
    {
        $sentence = 'Au revoir ' . $firstname;
        if ($lastname) {
            $sentence .= ' ' . $lastname;
        }

        return $sentence . '!';
    }
}