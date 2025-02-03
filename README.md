# Tests unitaires avec PHPUnit

- Ce projet utilise [PHPUnit](https://phpunit.de/) pour tester le code PHP de manière automatisée.  
- Ce guide vous aidera à installer, configurer et exécuter des tests unitaires.

 
## I. Installation

### 1. Installer PHPUnit via Composer

- Suivre la Documentation: [PHPUnit documentation](https://docs.phpunit.de/en/10.5/installation.html#installing-phpunit-with-composer)
- Exécuter: 
```composer require --dev phpunit/phpunit```


### 1. Architecture du projet

- Le projet doit avoir cette structure (la compléter si nécessaire): 

```
├── composer.json
├── composer.lock
├── public
├── src
├── tests
└── vendor
```

### 3. Configurer composer.json 

- Ajoutez ces lignes si elles ne sont pas déjà présentes:

```
{
    "require-dev": {
        "phpunit/phpunit": "^10.5"
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests"
        }
    }
```

### 4. Générer l’autoload

- Exécuter: `composer dump-autoload`

---

## II. Exécuter les tests 

### 1. Écrire un test de base

[PHPUnit Documentation](https://docs.phpunit.de/en/10.5/writing-tests-for-phpunit.html)

1. Créer une classe de service (HelloService.php): 

```
namespace App\Service;

class HelloService
{
    public function sayHello(string $firstname, ?string $lastname = null): ?string
    {
        $sentence = 'Hello ' . $firstname;
        if ($lastname) {
            $sentence .= ' ' . $lastname;
        }

        return $sentence . '!';
    }
```

2. Créer un test (HelloServiceTest.php):

```
namespace Tests;

use App\Service\HelloService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HelloServiceTest extends TestCase {
    
    public function testSayHello(): void
    {
        $helloService = new HelloService();
        $this->assertEquals("Hello, John!", $service->sayHello("John"));
    }
}
```

3. Lancer le test: 

- exécuter: `./vendor/phpunit/phpunit/phpunit tests/HelloServiceTest.php`
- Résultat attendu:

```
✅
Time: 00:00.007, Memory: 6.00 MB
OK (1 test, 1 assertion)
```

---

### 2. Utiliser les Data Providers

- Le Data Provider permet de tester plusieurs scénarios avec un même test.
- Voir la documentation complète : [PHPUnit Documentation](https://docs.phpunit.de/en/10.5/writing-tests-for-phpunit.html#data-providers)

- Le data provider (fournisseur de données) est une fonctionnalité qui permet de fournir plusieurs ensembles de données d'entrée à un test.
- Il est accessible sans créer une instance de la classe de tests (donc static).
- L'attribut #[DataProvider] permet de lier le fournisseur de données à une méthode de test.
- L’attribut #[DataProvider] est une fonctionnalité de PHPUnit, disponible à partir de PHPUnit 10 qui utilise des attributs PHP 8+.
- Il permet d'exécuter un même test avec différents paramètres pour vérifier que le comportement reste correct. 

#### Objectif principal:
- Un data provider aide à tester un code de manière exhaustive avec plusieurs scénarios sans dupliquer le test.

#### Exemple:

```
namespace Tests;

use App\Service\HelloService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HelloServiceTest extends TestCase
{
    public static function sayHelloProvider(): array
    {
        return [
            ['Georges', null, 'Hello Georges!', true],
            ['Sarah', null, 'Hello Sarah!'],
            ['Sarah', 'Miller', 'Hello Sarah Miller!'],
            ['Georges', 'Miller', 'Hello John Doe!', false],
            ['Sarah', 'Dupont', 'Hello Bernard Dupont!', false],
        ];
    }
    
    #[DataProvider('sayHelloProvider')]
    public function testSayHello(
        string $firstname,
        ?string $lastname,
        string $excepted,
        bool $isSame = true
    ): void {
        $helloService = new HelloService();
        $method = $isSame ? 'assertSame' : 'assertNotSame';

        $this->$method($excepted, $helloService->sayHello($firstname, $lastname));
    }
```


---

### 3. Tester la base de données

- Voir la Documentation: [PHPUnit Documentation](https://docs.phpunit.de/en/10.5/writing-tests-for-phpunit.html#test-dependencies)


#### 1. Créer une base de données (MySQL - MAMP) `unit_test`: 
```
table `user` with 4 columns `id`, `firstname`, `lastname`, `username`;
```

#### 2. Vérifier la connexion à la base de données (port: 8889 with MAMP not 3306); 

```
mysql -h 127.0.0.1 -P 8889 -u root -p
SHOW DATABASES;
USE unit_test;
SHOW TABLES;
exit; 
```

#### 3. Créer un service de connexion (DatabaseConnection.php)

```
namespace App\Service;

use PDO;
use PDOException;

class DatabaseConnection {
    private PDO $pdo;

    public function __construct() {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'];
        $this->pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
    }

    public function connect(): PDO {
        return $this->pdo;
    }
}
```
  
- Créer un fichier .env comprenant les identifiants pour se connecter
- Installer la bibliothèque : `composer require vlucas/phpdotenv`
- charger le .env dans le constructeurpour pouvoir utiliser les variables d'environnement 

---

#### 4. Créer un test de connexion (DatabaseConnectionTest.php)

```
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Service\DatabaseConnection;

class DatabaseConnectionTest extends TestCase {

    public function testConnect(): void
    {
        $databaseConnection = new DatabaseConnection();
        $pdo = $databaseConnection->connect();
        $this->assertInstanceOf(PDO::class, $pdo);

        // Test connection DB:if queries can be sent to the DB
        $stmt = $pdo->query("SELECT 1");
        $result = $stmt->fetchColumn();
        // Check if result is 1 it's OK
        $this->assertEquals(1, $result);
    }
}
```

#### 5. Exécuter le test

- Lancer la commande : `./vendor/phpunit/phpunit/phpunit tests/DatabaseConnectionTest.php`


#### 6. Ajouter des données dans la table `user`

- Teste son existance dans UserManagerTest; 
- Lance le test : ` ./vendor/phpunit/phpunit/phpunit tests/UserManagerTest.php`


---

### 4. Organiser et exécuter une suite de tests

#### 1. Créer un fichier phpunit.xml à la racine du projet

- Voir la [Documentation](https://docs.phpunit.de/en/10.5/organizing-tests.html)

- Par exemple pour tester un user (line 6)
- Organiser les tests :
```
<file>./test/unit/UserManager.php</file>
<file>./test/unit/UserEntity.php</file>
```

```
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/10.5/phpunit.xsd"
>
    <testsuites>
        <testsuite name="user">
            <file>./tests/UserManagerTest.php</file>
            <file>./tests/UserEntityTest.php</file>
        </testsuite>

        <testsuite name="integration">
            <directory>tests/integration</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

#### 2. Lancer tous les tests

- Exécuter: `./vendor/phpunit/phpunit/phpunit --testsuite user`


---

### 5. Autres fonctionnalités utiles 

#### 1. Test non terminé

- Si un test n'est pas terminé et qu'il ne doit pas empêcher les autres de tourner
- Ajoute ce code dans la méthode :

```
$this->markTestIncomplete('Test incomplet');
```

#### 2. Exécuter tous les tests du projet

- Exécuter: `./vendor/phpunit/phpunit/phpunit tests`

---

### 6. Ressources utiles 

- [PHPUnit Documentation Officielle](https://docs.phpunit.de/en/10.5/)
- [PHPUnit GitHub](https://github.com/sebastianbergmann/phpunit)

---

### 7. Conclusion 

Ce guide permet de : 
- Installer PHPUnit et configurer votre projet;
- Écrire des tests unitaires et les exécuter;
- Tester une base de données;
- Utiliser des suites de tests. 

