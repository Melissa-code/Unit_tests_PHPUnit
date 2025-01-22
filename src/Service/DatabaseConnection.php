<?php

namespace App\Service;

use Exception;
use PDO;
use Dotenv\Dotenv;
use PDOException;

class DatabaseConnection
{
    public function __construct()
    {
        // Load the file .env then the variables inside load()
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
    }

    public function connect(): PDO
    {
        $dbName = getenv('DBNAME');
        $host = getenv('HOST');
        $port = getenv('PORT');
        $user = getenv('USER');
        $password = getenv('PASSWORD') ?: '';
        $dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=utf8";

        try {
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }
}