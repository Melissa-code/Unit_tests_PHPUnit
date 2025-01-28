<?php

namespace App\Service;

use PDO;

class UserManager
{
    public function findUserByUsername(string $username): ?array
    {
        $databaseConnection = new DatabaseConnection();
        $pdo = $databaseConnection->connect();

        $query = $pdo->prepare('SELECT firstname, lastname, username FROM user where username = :username');
        $query->bindParam('username', $username);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if(!$user) {
            return null;
        }
        //var_dump($user);die();
        return $user;
    }
}