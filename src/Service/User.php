<?php

namespace App\Service;

use PDO;

class User
{
    public function findUserByUsername(string $username): array
    {
        $databaseConnection = new DatabaseConnection();
        $pdo = $databaseConnection->connect();

        $query = $pdo->prepare('SELECT * FROM user where username = :username');
        $query->bindParam('username', $username);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}