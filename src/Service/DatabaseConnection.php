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
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        /*
        if (!file_exists(__DIR__ . '/../../.env')) {
            echo "Le fichier .env n'a pas été trouvé !\n";
        }
        echo "Chemin absolu : " . __DIR__ . '/../../.env' . "\n";
        var_dump(getenv('DBNAME'), getenv('HOST'), getenv('PORT'), getenv('USER'), getenv('PASSWORD'));
        */
    }

    public function connect(): ?PDO
    {
        /*
        $dbName = getenv('DBNAME');
        $host = getenv('HOST');
        $port = getenv('PORT');
        $user = getenv('USER');
        $password = getenv('PASSWORD');

        $dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=utf8;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock";

        try {
            $pdo = new PDO($dsn, $user, $password);
            echo "Connexion réussie\n";
            return $pdo;
        } catch (PDOException $e) {
            echo 'Échec de la connexion : ' . $e->getMessage();
            throw new Exception("Erreur de connexion à la base de données: " . $e->getMessage());
        }
        return null;
        */

        $dsn = 'mysql:host=127.0.0.1;port=8889;dbname=unit_test;charset=utf8';
        $user = 'root';
        $password = 'root';

        try {
            $pdo = new PDO($dsn, $user, $password);
            echo "Connexion réussie";
            return $pdo;
        } catch (PDOException $e) {
            echo 'Échec de la connexion : ' . $e->getMessage();
        }
        return null;
    }
}