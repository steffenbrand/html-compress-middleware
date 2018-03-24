<?php

namespace SteffenBrand\HtmlCompressMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use WyriHaximus\HtmlCompress\Parser;

/**
 * Class UrlHelperMiddleware
 * @package Zend\Expressive\Helper
 */
class HtmlCompressMiddleware implements MiddlewareInterface
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * HtmlCompressMiddleware constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws \RuntimeException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $response = $handler->handle($request);

        if (strpos($response->getHeaderLine('Content-Type'), 'text/html') === false ||
            $response->getBody()->getSize() < 1)
        {
            return $response;
        }

        $compressedBody = $this->parser->compress($response->getBody()->getContents());
        $response->getBody()->write($compressedBody);

        return $response;
    }
}
