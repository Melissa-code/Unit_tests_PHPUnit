<?php

namespace Tests;

use App\Service\DatabaseConnection;
use PDO;
use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase
{
    public function testConnect()
    {
        $databaseConnection = new DatabaseConnection();
        $pdo = $databaseConnection->connect( );
        $this->assertInstanceOf(PDO::class, $pdo);

        // Test connection DB:if queries can be sent to the DB
        $stmt = $pdo->query("SELECT 1");
        $result = $stmt->fetchColumn();
        // Check if result is 1 it's OK
        $this->assertEquals(1, $result);
    }
}