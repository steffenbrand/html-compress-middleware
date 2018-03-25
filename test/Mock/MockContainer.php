<?php

namespace SteffenBrand\HtmlCompressMiddleware\Test\Mock;

use Psr\Container\ContainerInterface;

/**
 * Class MockContainer
 * @package SteffenBrand\HtmlCompressMiddleware\Test\Mock
 */
class MockContainer implements ContainerInterface
{
    /**
     * @var bool
     */
    private $debugValue;

    /**
     * MockContainer constructor.
     * @param bool $debugValue
     */
    public function __construct(bool $debugValue)
    {
        $this->debugValue = $debugValue;
    }

    /**
     * @param string $id
     * @return array|mixed
     */
    public function get($id)
    {
        return ['debug' => $this->debugValue];
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has($id)
    {
        return true;
    }
}