# Slim Views

This repository contains custom View classes for the template frameworks listed below. 
You can use any of these custom View classes by either requiring the appropriate class in your 
Slim Framework bootstrap file and initialize your Slim application using an instance of 
the selected View class or using Composer (the recommended way).

Slim Views only officially support the following views listed below.

- Smarty
- Twig

## How to Install

### using [Composer](http://getcomposer.org/)

Create a composer.json file in your project root:

    {
        "require": {
            "slim/views": "1.0.*"
        }
    }

Then run the following composer command:

    php composer.phar install


## Smarty

### How to use

    <?php
    require 'vendor/autoload.php';

    $app = new \Slim\Slim(array(
        'view' => new \Slim\Views\Smarty()
    ));

To use Smarty options do the following:

    $view = $app->view();
    $view->parserDirectory = dirname(__FILE__) . 'smarty';
    $view->parserCompileDirectory = dirname(__FILE__) . '/compiled';
    $view->parserCacheDirectory = dirname(__FILE__) . '/cache';
    $view->parserExtensions = dirname(__FILE__) . 'vendor/slim/views/Slim/Views/smartyplugins';


## Twig

### How to use

    <?php
    require 'vendor/autoload.php';

    $app = new \Slim\Slim(array(
        'view' => new \Slim\Views\Twig()
    ));

To use Twig options do the following:

    $view = $app->view();
    $view->parserOptions = array(
        'debug' => true,
        'cache' => dirname(__FILE__) . '/cache'
    );
    $view->parserExtensions = array(
        new \Slim\Views\TwigExtension(),
    );


## Author

[Josh Lockhart](https://github.com/codeguy)
[Andrew Smith](https://github.com/silentworks)

## License

MIT Public License