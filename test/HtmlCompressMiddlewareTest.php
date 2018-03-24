<?php

namespace SteffenBrand\HtmlCompressMiddleware\Test;

use PHPUnit\Framework\TestCase;
use SteffenBrand\HtmlCompressMiddleware\HtmlCompressMiddleware;
use SteffenBrand\HtmlCompressMiddleware\HtmlCompressMiddlewareFactory;
use SteffenBrand\HtmlCompressMiddleware\Test\RequestHandler\MockHtmlRequestHandler;
use SteffenBrand\HtmlCompressMiddleware\Test\RequestHandler\MockJsonRequestHandler;
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
     * @var HtmlCompressMiddleware
     */
    private $middleware;

    public function setUp()
    {
        $this->request = new ServerRequest();
        $this->request = $this->request->withBody(new Stream(fopen('data:text/plain,' . 'test' . PHP_EOL . 'test', 'rb')));

        $factory = new HtmlCompressMiddlewareFactory();
        $this->middleware = $factory->__invoke();
    }

    public function testHtmlResponseIsCompressed(): void
    {
        $response = $this->middleware->process($this->request, new MockHtmlRequestHandler());

        $this->assertEquals('test test', $response->getBody()->getContents());
    }

    public function testJsonResponseIsNotCompressed(): void
    {
        $response = $this->middleware->process($this->request, new MockJsonRequestHandler());

        $this->assertEquals('test' . PHP_EOL . 'test', $response->getBody()->getContents());
    }
}