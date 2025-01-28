<?php

namespace App\Entity;

use InvalidArgumentException;

class User
{
    private array $favoriteMovies = [];
    private int $age;
    private string $name;

    public function __construct(int $age, string $name)
    {
        $this->age = $age;
        $this->name = $name;
    }


    public function getFavoriteMovies(): ?array
    {
        return $this->favoriteMovies;
    }

    public function setFavoriteMovies(array $favoriteMovies): void
    {
        $this->favoriteMovies = $favoriteMovies;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function tellName(): string
    {
        return "Mon nom est ".$this->name.".";
    }

    public function tellAge(): string
    {
        return "Mon âge est ".$this->age." ans.";
    }

    public function addFavoriteMovie(string $movie): bool
    {
        $this->favoriteMovies[] = $movie;

        return true;
    }

    public function removeFavoriteMovie(string $movie): bool
    {
        if (!in_array($movie, $this->favoriteMovies)) throw new InvalidArgumentException("Film inconnu: ".$movie);
        unset($this->favoriteMovies[array_search($movie, $this->favoriteMovies)]);

        return true;
    }
}