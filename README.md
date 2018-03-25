# HTML Compress Middleware
PSR-15 compliant middleware to compress html responses.

* [CurrCurr on Packagist](https://packagist.org/packages/steffenbrand/curr-curr)
* [CurrCurr on GitHub](https://github.com/steffenbrand/curr-curr)

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