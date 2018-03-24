<?php

namespace SteffenBrand\HtmlCompressMiddleware;

use WyriHaximus\HtmlCompress\Factory;

/**
 * Class HtmlCompressMiddlewareFactory
 * @package SteffenBrand\HtmlCompressMiddleware
 */
class HtmlCompressMiddlewareFactory
{
    /**
     * @return HtmlCompressMiddleware
     */
    public function __invoke(): HtmlCompressMiddleware
    {
        return new HtmlCompressMiddleware(Factory::construct());
    }
}
