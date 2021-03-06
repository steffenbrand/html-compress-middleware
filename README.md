[![Latest Stable Version](https://poser.pugx.org/steffenbrand/html-compress-middleware/v/stable)](https://packagist.org/packages/steffenbrand/html-compress-middleware)
[![Total Downloads](https://poser.pugx.org/steffenbrand/html-compress-middleware/downloads)](https://packagist.org/packages/steffenbrand/html-compress-middleware)
[![Build Status](https://scrutinizer-ci.com/g/steffenbrand/html-compress-middleware/badges/build.png?b=master)](https://scrutinizer-ci.com/g/steffenbrand/html-compress-middleware/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/steffenbrand/html-compress-middleware/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/steffenbrand/html-compress-middleware/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/steffenbrand/html-compress-middleware/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/steffenbrand/html-compress-middleware/?branch=master)

# HTML Compress Middleware
PSR-15 compliant middleware to compress html responses.

* [HTML Compress Middleware on Packagist](https://packagist.org/packages/steffenbrand/html-compress-middleware)
* [HTML Compress Middleware on GitHub](https://github.com/steffenbrand/html-compress-middleware)

![Concept](https://github.com/steffenbrand/html-compress-middleware/blob/master/concept.jpg?raw=true)

## How to install

```
composer require steffenbrand/html-compress-middleware
```

## How to use with Zend Expressive 3

Add the middleware to your `config/pipeline.php`

```php
/**
 * Setup middleware pipeline:
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    // The error handler should be the first (most outer) middleware to catch
    // all Exceptions.
    $app->pipe(ErrorHandler::class);
    $app->pipe(HtmlCompressMiddleware::class);
    ...
 }
```

Add the middleware to your `config/autoload/dependencies.global.php`  
Or use it as a [routed middleware](https://zendframework.github.io/zend-expressive/v3/getting-started/features/#flow-overview), if you don't want the middleware to be invoked on certain routes.

```php
return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        ...
        'factories'  => [
            // Fully\Qualified\ClassName::class => Fully\Qualified\FactoryName::class,
            \SteffenBrand\HtmlCompressMiddleware\HtmlCompressMiddleware::class => \SteffenBrand\HtmlCompressMiddleware\HtmlCompressMiddlewareFactory::class,
        ],
    ],
];
```

### Enable compression

To enable compression disable the development mode.  
HTML compression is only meant for production.

```
composer development-disable
```

### Disable compression

To disable compression enable the development mode.   
HTML compression will not run in development mode.

```
composer development-enable
```

Or provide your own development-mode settings by editing the file `config/autoload/development.local.php.dist`