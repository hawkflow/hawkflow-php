<?php

namespace HawkFlow\HawkFlow;

final class ClientHelper
{
    /**
     * @param array $headers
     * @return int
     */
    final public static function parseStatusCode(array $headers): int
    {
        if ( ! isset($headers[0])) {
            return 0;
        }

        if (preg_match('/\d{3}/', $headers[0], $matches)) {
            return (int)$matches[0];
        }

        return 0;
    }

    /**
     * @param string $apiKey
     * @param string $content
     * @return array
     */
    final static function createContextOptions(string $apiKey, string $content): array
    {
        return [
            'http' => [
                'timeout' => 1,
                'ignore_errors' => true,
                'method' => 'POST',
                'header' => \implode("\r\n", [
                    'content-type: application/json',
                    \sprintf('x-hawkflow-api-key: %s', $apiKey),
                ]),
                'content' => $content,
            ],
        ];
    }
}
