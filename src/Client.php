<?php

namespace HawkFlow\HawkFlow;

class Client
{
    /**
     * @param string $url
     * @param string $apiKey
     * @param string $content
     * @return false|resource
     */
    public function call(string $url, string $apiKey, string $content)
    {
        $options = ClientHelper::createContextOptions($apiKey, $content);
        $context = \stream_context_create($options);
        return @\fopen($url, 'r', false, $context);
    }

    /**
     * @param resource $stream
     * @return array
     */
    public function getHeaders($stream): array
    {
        return stream_get_meta_data($stream)['wrapper_data'] ?? [];
    }

    /**
     * @param resource $stream
     * @return string
     */
    public function getBody($stream): string
    {
        return trim(\stream_get_contents($stream));
    }
}
