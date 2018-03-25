<?php

namespace SteffenBrand\HtmlCompressMiddleware\Test;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response;

/**
 * Class MockRequestHandler
 * @package SteffenBrand\HtmlCompressMiddleware\Test
 */
class MockRequestHandler implements RequestHandlerInterface
{
    /**
     * @var Response
     */
    private $response;

    public function __construct(string $contentType)
    {
        $this->response = new Response();
        $this->response = $this->response->withHeader('Content-Type', $contentType);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->response = $this->response->withBody($request->getBody());

        return $this->response;
    }
}