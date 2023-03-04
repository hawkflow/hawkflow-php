<?php

namespace HawkFlow\HawkFlow\Tests\Mocks;

use HawkFlow\HawkFlow\Client;

class MockClient extends Client
{
    /**
     * @var array
     */
    private array $headers = [];

    /**
     * @var string
     */
    private string $body = '';

    /**
     * @var resource $resource
     */
    private $resource;

    /**
     * @var int
     */
    public int $callCount = 0;

    /**
     * @var array
     */
    public array $callData = [];

    /**
     * MockClient constructor.
     *
     * @param array $headers
     * @param string $body
     * @param null $resource
     */
    public function __construct(array $headers, string $body, $resource = null)
    {
        $this->headers = $headers;
        $this->body = $body;

        if (is_null($resource)) {
            $this->resource = fopen('php://memory', 'r+');
        } else {
            $this->resource = $resource;
        }
    }

    /**
     * @param string $url
     * @param string $apiKey
     * @param string $content
     * @return false|resource
     */
    public function call(string $url, string $apiKey, string $content)
    {
        $this->callCount++;
        $this->callData = [
            'url' => $url,
            'apiKey' => $apiKey,
            'content' => $content,
        ];

        return $this->resource;
    }

    /**
     * @param resource $stream
     * @return array
     */
    public function getHeaders($stream): array
    {
        return $this->headers;
    }

    /**
     * @param resource $stream
     * @return string
     */
    public function getBody($stream): string
    {
        return $this->body;
    }
}
