# Unit Tests (PHPUnit)
 
## Installation 

[PHPUnit documentation](https://docs.phpunit.de/en/10.5/installation.html#installing-phpunit-with-composer)

1. Install PHPUnit with Composer :

```composer require --dev phpunit/phpunit```

The architecture must be like that (complete it if necessary): 
```
├── composer.json
├── composer.lock
├── public
├── src
├── tests
└── vendor
```

2. Complete the composer.json file: 

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

3. run: `composer dump-autoload`



## Tests 

[PHPUnit Documentation](https://docs.phpunit.de/en/10.5/writing-tests-for-phpunit.html)

1. Create a PHP Class (HelloService) in the Service directory
- Write a function sayHello($name)

2. Create a PHP Class (HelloServiceTest) in the tests directory 
- Write a function to test sayHello($name) wich starts with testSayHello()

3. Run the test: `./vendor/phpunit/phpunit/phpunit tests/HelloServiceTest.php`

```
Time: 00:00.007, Memory: 6.00 MB
OK (1 test, 1 assertion)
```


### Data providers 

[PHPUnit Documentation](https://docs.phpunit.de/en/10.5/writing-tests-for-phpunit.html#data-providers)

- Le data provider (fournisseur de données) est une fonctionnalité qui permet de fournir plusieurs ensembles de données d'entrée à un test.
- Il est accessible sans créer une instance de la classe de tests (donc static).
- L'attribut #[DataProvider] permet de lier le fournisseur de données à une méthode de test.
- L’attribut #[DataProvider] est une fonctionnalité de PHPUnit, disponible à partir de PHPUnit 10 qui utilise des attributs PHP 8+.
- Il permet d'exécuter un même test avec différents paramètres pour vérifier que le comportement reste correct. 

#### Objectif principal :
- Un data provider aide à tester un code de manière exhaustive avec plusieurs scénarios sans dupliquer le test.


### Enchaînement de tests 

[PHPUnit Documentation](https://docs.phpunit.de/en/10.5/writing-tests-for-phpunit.html#test-dependencies)

- Test qui dépend d'un autre test (ex: test qui dépend du test qui vérifie la bonne connexion à la base de données)
- Dérouler des tests avec des conditions

- Create a database in PHPMyAdmin : `unit_test`, table `user` with 4 columns `id`, `firstname`, `lastname`, `username`;
- Check the connection to the database in the terminal (port: 8889 with MAMP not 3306); 

```
mysql -h 127.0.0.1 -P 8889 -u root -p
SHOW DATABASES;
USE unit_test;
SHOW TABLES;
exit; 
```

- Une class dans Service pour se connecter à la base de données; 
- Créer une class dans tests pour la tester;
  
- Create a .env with the credentials to connect to the database
- Install the library : `composer require vlucas/phpdotenv`
- load the .env file with variables in the constructor DatabaseConnection to use them 
- Create the connect() function & Test the connect() function
- Run test : `./vendor/phpunit/phpunit/phpunit tests/DatabaseConnectionTest.php`

- Add data in `user` table; 
