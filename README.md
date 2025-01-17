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

