<?php

namespace SteffenBrand\HtmlCompressMiddleware\Test\Mock;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response;

/**
 * Class MockRequestHandler
 * @package SteffenBrand\HtmlCompressMiddleware\Test\Mock
 */
class MockRequestHandler implements RequestHandlerInterface
{
    /**
     * @var Response
     */
    private $response;

    /**
     * MockRequestHandler constructor.
     * @param string $contentType
     */
    public function __construct(string $contentType)
    {
        $this->response = new Response();
        $this->response = $this->response->withHeader('Content-Type', $contentType);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->response = $this->response->withBody($request->getBody());

        return $this->response;
    }
}