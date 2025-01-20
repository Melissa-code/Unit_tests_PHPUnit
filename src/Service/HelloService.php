<?php

namespace App\Service;

class HelloService
{
    public function sayHello(string $firstname, ?string $lastname = null): ?string
    {
        if (!$lastname) {
            $sentence  = 'Hello ' . $firstname . '!';
        } else {
            $sentence  = 'Hello ' . $firstname . ' '. $lastname . '!';
        }

        return $sentence;
    }

    public function sayGoodbye(string $firstname, ?string $lastname = null): ?string
    {
        if (!$lastname) {
            $sentence  = 'Au revoir ' . $firstname . '!';
        } else {
            $sentence  = 'Au revoir ' . $firstname . ' '. $lastname . '!';
        }

        return $sentence;
    }
}