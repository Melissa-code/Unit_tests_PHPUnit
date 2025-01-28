<?php

namespace Tests;

use App\Entity\User;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function testUserConstructor(): void
    {
        $user = new User(33, "John");

        $this->assertSame(33, $user->getAge());
        $this->assertSame("John", $user->getName());
        $this->assertEmpty($user->getFavoriteMovies());
    }

    public function testTellName(): void
    {
        $user = new User(33, "John");

        $this->assertIsString($user->tellName());
        $this->assertStringContainsString("John", $user->tellName());
        $this->assertStringContainsStringIgnoringCase("John", $user->tellName());
    }

    public function testTellAge(): void
    {
        $user = new User(33, "John");

        $this->assertIsString($user->tellAge());
        $this->assertStringContainsString(33, $user->tellAge());
    }

    public function testAddAndRemoveFavoriteMovies(): void
    {
        $user = new User(33, "John");

        $this->assertTrue($user->addFavoriteMovie("The Shinning"));
        $this->assertTrue($user->addFavoriteMovie("Alien"));
        $this->assertTrue($user->addFavoriteMovie("Flow"));
        $this->assertContains("Alien", $user->getFavoriteMovies());
        $this->assertContains("Flow", $user->getFavoriteMovies());
        $this->assertCount(3, $user->getFavoriteMovies());

        $this->assertTrue($user->removeFavoriteMovie("Alien"));
        $this->assertTrue($user->removeFavoriteMovie("Flow"));
        $this->assertNotContains("Alien", $user->getFavoriteMovies());
        $this->assertNotContains("Flow", $user->getFavoriteMovies());
        $this->assertCount(1, $user->getFavoriteMovies());
        $this->assertContains("The Shinning", $user->getFavoriteMovies());
    }

    public function testFailedRemoveFavoriteMovies(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $user = new User(33, "John");
        $user->removeFavoriteMovie("The Shinning");
    }
}