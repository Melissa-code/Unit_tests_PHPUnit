<?php

namespace Tests;

use App\Service\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * Test the existence of a user in the database
     */
    public function testGetUserByUsernameForExisting(): void
    {
        $user = new User();
        $userToTest = $user->findUserByUsername('s.veille');
        $dataUser = [
            "firstname" => "Simone",
            "lastname" => "Veille",
            "username" => "s.veille"
        ];

        $this->assertSame($dataUser, $userToTest);
    }

    /**
     * Test the absence of a user in the database
     */
    public function testGetUserByUsernameForNotExisting(): void
    {
        $user = new User();
        $userToTest = $user->findUserByUsername('j.doe');
        $this->assertEmpty($userToTest, "Utilisateur inexistant en base de données");
    }
}