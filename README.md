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

3. run: `Run composer dump-autoload`



## Tests 

[PHPUnit Documentation](https://docs.phpunit.de/en/10.5/writing-tests-for-phpunit.html)

1. Create a PHP Class (HelloService) in the Service directory
- Write a function sayHello($name)

2. Create a PHP Class (HelloServiceTest) in the tests directory 
- Write a function to test sayHello($name)

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
