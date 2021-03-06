<?php

namespace SteffenBrand\HtmlCompressMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use WyriHaximus\HtmlCompress\Parser;
use Zend\Diactoros\Stream;

/**
 * Class HtmlCompressMiddleware
 * @package SteffenBrand\HtmlCompressMiddleware
 */
class HtmlCompressMiddleware implements MiddlewareInterface
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var bool
     */
    private $debug;

    /**
     * HtmlCompressMiddleware constructor.
     * @param Parser $parser
     * @param bool $debug
     */
    public function __construct(Parser $parser, bool $debug)
    {
        $this->parser = $parser;
        $this->debug = $debug;
     }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws \InvalidArgumentException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        if ($this->debug === true ||
            strpos($response->getHeaderLine('Content-Type'), 'text/html') === false ||
            $response->getBody()->getSize() < 1)
        {
            return $response;
        }

        $compressedBody = $this->parser->compress($response->getBody()->getContents());
        $streamBody = fopen('data:text/plain,' . $compressedBody, 'rb');

        return $response->withBody(new Stream($streamBody));
    }
}
