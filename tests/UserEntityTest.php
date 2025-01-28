<?php

namespace Tests;

use App\Entity\User;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public static function userProvider(): ?array
    {
        return [
            ['John', 33, ["The Shinning", "Alien", "Flow"]],
            ['Alice', 19, []],
        ];
    }

    #[DataProvider('userProvider')]
    public function testUserConstructor(string $name, int $age): void
    {
        $user = new User($age, $name);

        $this->assertSame($age, $user->getAge());
        $this->assertSame($name, $user->getName());
        $this->assertEmpty($user->getFavoriteMovies());
    }

    #[DataProvider('userProvider')]
    public function testTellName(string $name, int $age): void
    {
        $user = new User($age, $name);

        $this->assertIsString($user->tellName());
        $this->assertStringContainsString( $name, $user->tellName());
        $this->assertStringContainsStringIgnoringCase( $name, $user->tellName());
    }

    #[DataProvider('userProvider')]
    public function testTellAge(string $name, int $age): void
    {
        $user = new User($age, $name);

        $this->assertIsString($user->tellAge());
        $this->assertStringContainsString( $age, $user->tellAge());
    }

    #[DataProvider('userProvider')]
    public function testAddAndRemoveFavoriteMovies(string $name, int $age, array $movies): void
    {
        $user = new User($age, $name);

        foreach ($movies as $movie) {
            $this->assertTrue($user->addFavoriteMovie($movie));
            $this->assertContains($movie, $user->getFavoriteMovies());
        }

        $this->assertCount(count($movies), $user->getFavoriteMovies());

        if (count($movies) === 0) {
            return;
        }

        foreach ($movies as $movie) {
            $this->assertTrue($user->removeFavoriteMovie($movie));
            $this->assertNotContains($movie, $user->getFavoriteMovies());
        }

        $this->assertCount(0, $user->getFavoriteMovies());
    }

   #[DataProvider('userProvider')]
   public function testFailedRemoveFavoriteMovies(string $name, int $age): void
   {
       $this->expectException(InvalidArgumentException::class);

       $user = new User($age, $name);
       $user->removeFavoriteMovie("The Shinning");
   }

}