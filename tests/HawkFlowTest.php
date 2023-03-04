<?php

namespace HawkFlow\HawkFlow\Tests;

use HawkFlow\HawkFlow\HawkFlow;
use HawkFlow\HawkFlow\Tests\Mocks\MockClient;
use PHPUnit\Framework\TestCase;

class HawkFlowTest extends TestCase
{
    /** @test */
    public function start_proper_request_sent()
    {
        $apiKey = 'api_key';
        $process = 'process_name';
        $meta = 'meta data';
        $uid = 'uid';
        $body = '{"status":201,"message":"created"}';
        $expectedCallData = [
            'url' => 'https://api.hawkflow.ai/v1/start',
            'apiKey' => $apiKey,
            'content' => '{"process":"process_name","meta":"meta data","uid":"uid"}',
        ];

        $hawkFlow = new HawkFlow($apiKey);
        $mockClient = new MockClient(['HTTP/1.2 201 Created', 'Content-Type: application/json'], $body);
        $hawkFlow->client = $mockClient;

        $apiResponse = $hawkFlow->start($process, $meta, $uid);

        $this->assertSame(1, $mockClient->callCount);
        $this->assertSame($expectedCallData, $mockClient->callData);
        $this->assertSame($body, $apiResponse);
    }

    /** @test */
    public function start_retried()
    {
        $apiKey = 'api_key';
        $retryCount = 2;
        $process = 'process_name';
        $meta = '';
        $uid = '';

        $hawkFlow = new HawkFlow($apiKey, $retryCount);
        $mockClient = new MockClient([], '', false);
        $hawkFlow->client = $mockClient;

        $apiResponse = $hawkFlow->start($process, $meta, $uid);

        $this->assertSame($retryCount, $mockClient->callCount);
        $this->assertSame('Connection failed permanently Please see documentation at https://docs.hawkflow.ai/integration/index.html', $apiResponse);
    }

    /** @test */
    public function start_api_validated()
    {
        $apiKey = 'invalid api key ❌';
        $process = 'process_name';
        $meta = '';
        $uid = '';

        $hawkFlow = new HawkFlow($apiKey);
        $mockClient = new MockClient([], '', false);
        $hawkFlow->client = $mockClient;

        $apiResponse = $hawkFlow->start($process, $meta, $uid);

        $this->assertSame('Invalid API Key format. Please see documentation at https://docs.hawkflow.ai/integration/index.html', $apiResponse);
    }

    /** @test */
    public function end_proper_request_sent()
    {
        $apiKey = 'api_key';
        $process = 'process_name';
        $meta = 'meta data';
        $uid = 'uid';
        $body = '{"status":201,"message":"created"}';
        $expectedCallData = [
            'url' => 'https://api.hawkflow.ai/v1/end',
            'apiKey' => $apiKey,
            'content' => '{"process":"process_name","meta":"meta data","uid":"uid"}',
        ];

        $hawkFlow = new HawkFlow($apiKey);
        $mockClient = new MockClient(['HTTP/1.2 201 Created', 'Content-Type: application/json'], $body);
        $hawkFlow->client = $mockClient;

        $apiResponse = $hawkFlow->end($process, $meta, $uid);

        $this->assertSame(1, $mockClient->callCount);
        $this->assertSame($expectedCallData, $mockClient->callData);
        $this->assertSame($body, $apiResponse);
    }

    /** @test */
    public function end_retried()
    {
        $apiKey = 'api_key';
        $retryCount = 2;
        $process = 'process_name';
        $meta = '';
        $uid = '';

        $hawkFlow = new HawkFlow($apiKey, $retryCount);
        $mockClient = new MockClient([], '', false);
        $hawkFlow->client = $mockClient;

        $apiResponse = $hawkFlow->end($process, $meta, $uid);

        $this->assertSame($retryCount, $mockClient->callCount);
        $this->assertSame('Connection failed permanently Please see documentation at https://docs.hawkflow.ai/integration/index.html', $apiResponse);
    }

    /** @test */
    public function end_api_validated()
    {
        $apiKey = 'invalid api key ❌';
        $process = 'process_name';
        $meta = '';
        $uid = '';

        $hawkFlow = new HawkFlow($apiKey);
        $mockClient = new MockClient([], '', false);
        $hawkFlow->client = $mockClient;

        $apiResponse = $hawkFlow->end($process, $meta, $uid);

        $this->assertSame('Invalid API Key format. Please see documentation at https://docs.hawkflow.ai/integration/index.html', $apiResponse);
    }

    /** @test */
    public function exception_proper_request_sent()
    {
        $apiKey = 'api_key';
        $message = 'exception message';
        $process = 'process_name';
        $meta = 'meta data';
        $body = '{"status":201,"message":"created"}';
        $expectedCallData = [
            'url' => 'https://api.hawkflow.ai/v1/exception',
            'apiKey' => $apiKey,
            'content' => '{"message":"exception message","process":"process_name","meta":"meta data"}',
        ];

        $hawkFlow = new HawkFlow($apiKey);
        $mockClient = new MockClient(['HTTP/1.2 201 Created', 'Content-Type: application/json'], $body);
        $hawkFlow->client = $mockClient;

        $apiResponse = $hawkFlow->exception($message, $process, $meta);

        $this->assertSame(1, $mockClient->callCount);
        $this->assertSame($expectedCallData, $mockClient->callData);
        $this->assertSame($body, $apiResponse);
    }

    /** @test */
    public function exception_retried()
    {
        $apiKey = 'api_key';
        $message = 'exception message';
        $retryCount = 4;
        $process = 'process_name';
        $meta = '';

        $hawkFlow = new HawkFlow($apiKey, $retryCount);
        $mockClient = new MockClient([], '', false);
        $hawkFlow->client = $mockClient;

        $apiResponse = $hawkFlow->exception($message, $process, $meta);

        $this->assertSame($retryCount, $mockClient->callCount);
        $this->assertSame('Connection failed permanently Please see documentation at https://docs.hawkflow.ai/integration/index.html', $apiResponse);
    }

    /** @test */
    public function exception_api_validated()
    {
        $apiKey = 'invalid api key ❌';
        $message = 'exception message';
        $process = 'process_name';
        $meta = '';

        $hawkFlow = new HawkFlow($apiKey);
        $mockClient = new MockClient([], '', false);
        $hawkFlow->client = $mockClient;

        $apiResponse = $hawkFlow->exception($message, $process, $meta);

        $this->assertSame('Invalid API Key format. Please see documentation at https://docs.hawkflow.ai/integration/index.html', $apiResponse);
    }

    /** @test */
    public function metrics_proper_request_sent()
    {
        $apiKey = 'api_key';
        $items = ['key' => 123, 'a' => 45.67];
        $process = 'process_name';
        $meta = 'meta data';
        $body = '{"status":201,"message":"created"}';
        $expectedCallData = [
            'url' => 'https://api.hawkflow.ai/v1/metrics',
            'apiKey' => $apiKey,
            'content' => '{"items":{"key":123,"a":45.67},"process":"process_name","meta":"meta data"}',
        ];

        $hawkFlow = new HawkFlow($apiKey);
        $mockClient = new MockClient(['HTTP/1.2 201 Created', 'Content-Type: application/json'], $body);
        $hawkFlow->client = $mockClient;

        $apiResponse = $hawkFlow->metrics($items, $process, $meta);

        $this->assertSame(1, $mockClient->callCount);
        $this->assertSame($expectedCallData, $mockClient->callData);
        $this->assertSame($body, $apiResponse);
    }

    /** @test */
    public function metrics_retried()
    {
        $apiKey = 'api_key';
        $retryCount = 2;
        $items = ['key' => 123];
        $process = 'process_name';
        $meta = '';

        $hawkFlow = new HawkFlow($apiKey, $retryCount);
        $mockClient = new MockClient([], '', false);
        $hawkFlow->client = $mockClient;

        $apiResponse = $hawkFlow->metrics($items, $process, $meta);

        $this->assertSame($retryCount, $mockClient->callCount);
        $this->assertSame('Connection failed permanently Please see documentation at https://docs.hawkflow.ai/integration/index.html', $apiResponse);
    }

    /** @test */
    public function metrics_api_validated()
    {
        $apiKey = 'invalid api key ❌';
        $items = ['key' => 123];
        $process = 'process_name';
        $meta = '';

        $hawkFlow = new HawkFlow($apiKey);
        $mockClient = new MockClient([], '', false);
        $hawkFlow->client = $mockClient;

        $apiResponse = $hawkFlow->metrics($items, $process, $meta);

        $this->assertSame('Invalid API Key format. Please see documentation at https://docs.hawkflow.ai/integration/index.html', $apiResponse);
    }
}
