# Unit Tests (PHPUnit)
 

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
            "App\\": "src"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests"
        }
    }
}
```

