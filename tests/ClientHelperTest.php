<?php

namespace HawkFlow\HawkFlow\Tests;

use HawkFlow\HawkFlow\ClientHelper;
use PHPUnit\Framework\TestCase;

class ClientHelperTest extends TestCase
{
    /** @test */
    public function valid_parsing_status_code()
    {
        $headers = [
            'HTTP/1.1 201 Created',
        ];
        $statusCode = ClientHelper::parseStatusCode($headers);

        $this->assertSame(201, $statusCode);
    }

    /** @test */
    public function test_create_context_options()
    {
        $apiKey = 'api_key';
        $content = '{"process":"process_name"}';
        $expectedOptions = [
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

        $options = ClientHelper::createContextOptions($apiKey, $content);

        $this->assertSame($expectedOptions, $options);
    }
}
