<?php

namespace Tests;

use App\Service\UserManager;
use PHPUnit\Framework\TestCase;

class UserManagerTest extends TestCase
{
    /**
     * Test the existence of a user in the database
     */
    public function testGetUserByUsernameForExisting(): void
    {
        $user = new UserManager();
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
        $user = new UserManager();
        $userToTest = $user->findUserByUsername('j.doe');
        $this->assertEmpty($userToTest, "Utilisateur inexistant en base de données");
    }
}