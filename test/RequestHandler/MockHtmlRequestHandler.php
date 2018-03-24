<?php

namespace SteffenBrand\HtmlCompressMiddleware\Test\RequestHandler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response;

/**
 * Class MockHtmlRequestHandler
 * @package SteffenBrand\HtmlCompressMiddleware\Test\RequestHandler
 */
class MockHtmlRequestHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = new Response();
        $response = $response->withBody($request->getBody());
        $response = $response->withHeader('Content-Type', 'text/html');

        return $response;
    }
}