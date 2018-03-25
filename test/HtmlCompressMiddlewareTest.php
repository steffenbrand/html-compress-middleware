<?php

namespace SteffenBrand\HtmlCompressMiddleware\Test;

use PHPUnit\Framework\TestCase;
use SteffenBrand\HtmlCompressMiddleware\HtmlCompressMiddlewareFactory;
use SteffenBrand\HtmlCompressMiddleware\Test\Mock\MockContainer;
use SteffenBrand\HtmlCompressMiddleware\Test\Mock\MockRequestHandler;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Stream;

/**
 * Class HtmlCompressMiddlewareTest
 * @package SteffenBrand\HtmlCompressMiddleware\Test
 */
class HtmlCompressMiddlewareTest extends TestCase
{
    /**
     * @var ServerRequest
     */
    private $request;

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function setUp()
    {
        $this->request = new ServerRequest();
        $this->request = $this->request->withBody(new Stream(fopen('data:text/plain,' . 'test' . PHP_EOL . 'test', 'rb')));
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function testHtmlResponseIsCompressed(): void
    {
        $middleware = (new HtmlCompressMiddlewareFactory())->__invoke(new MockContainer(false));
        $response = $middleware->process($this->request, new MockRequestHandler('text/html'));

        $this->assertEquals('test test', $response->getBody()->getContents());
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function testJsonResponseIsNotCompressed(): void
    {
        $middleware = (new HtmlCompressMiddlewareFactory())->__invoke(new MockContainer(false));
        $response = $middleware->process($this->request, new MockRequestHandler('application/json'));

        $this->assertEquals('test' . PHP_EOL . 'test', $response->getBody()->getContents());
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function testDebugHtmlResponseIsNotCompressed(): void
    {
        $middleware = (new HtmlCompressMiddlewareFactory())->__invoke(new MockContainer(true));
        $response = $middleware->process($this->request, new MockRequestHandler('text/html'));

        $this->assertEquals('test' . PHP_EOL . 'test', $response->getBody()->getContents());
    }
}