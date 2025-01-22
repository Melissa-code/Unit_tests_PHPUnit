<?php

namespace Tests;

use App\Service\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetUserByUsername(): void
    {
        $user = new User();
        $userToTest = $user->findUserByUsername('s.veille');
        $dataUser = [
            "id" => 1,
            "firstname" => "Simone",
            "lastname" => "Veille",
            "username" => "s.veille"
        ];

        $this->assertSame($dataUser, $userToTest);
    }
}