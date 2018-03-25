<?php

namespace SteffenBrand\HtmlCompressMiddleware;

use Psr\Container\ContainerInterface;
use WyriHaximus\HtmlCompress\Factory;

/**
 * Class HtmlCompressMiddlewareFactory
 * @package SteffenBrand\HtmlCompressMiddleware
 */
class HtmlCompressMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     * @return HtmlCompressMiddleware
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): HtmlCompressMiddleware
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $debug = $config['debug'] ?? false;

        return new HtmlCompressMiddleware(Factory::construct(), $debug);
    }
}
