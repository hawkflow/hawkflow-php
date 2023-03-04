<?php

namespace HawkFlow\HawkFlow;

class HawkFlow
{
    /**
     * Must end with backslash
     *
     * @var string
     */
    const URL = 'https://api.hawkflow.ai/v1';

    /**
     * @var Client
     */
    public Client $client;

    /**
     * @var string
     */
    private string $apiKey;

    /**
     * @var int $maxRetries
     */
    private int $maxRetries;

    /**
     * @var int $timeout
     */
    private int $timeout;

    /**
     * @var bool $debug
     */
    private bool $debug;

    /**
     * HawkFlow constructor
     *
     * @param string $apiKey
     * @param int $maxRetries (optional)
     * @param int $timeout (optional)
     * @param bool $debug (optional)
     */
    public function __construct(string $apiKey, int $maxRetries = 3, int $timeout = 1, bool $debug = false)
    {
        $this->apiKey = $apiKey;
        $this->maxRetries = $maxRetries;
        $this->timeout = $timeout;
        $this->debug = $debug;

        $this->client = new Client;
    }

    /**
     * @param string $process
     * @param string $meta (optional)
     * @param string $uid (optional)
     * @return string
     */
    public function start(string $process, string $meta = '', string $uid = ''): string
    {
        try {
            $data = Request::timedData($process, $meta, $uid);

            return $this->send('start', $data);
        } catch (HawkFlowException $e) {
            $this->log($e->getMessage());

            return $e->getMessage();
        }
    }

    /**
     * @param string $process
     * @param string $meta (optional)
     * @param string $uid (optional)
     * @return string
     */
    public function end(string $process, string $meta = '', string $uid = ''): string
    {
        try {
            $data = Request::timedData($process, $meta, $uid);

            return $this->send('end', $data);
        } catch (HawkFlowException $e) {
            $this->log($e->getMessage());

            return $e->getMessage();
        }
    }

    /**
     * @param string $message
     * @param string $process
     * @param string $meta (optional)
     * @return string
     */
    public function exception(string $message, string $process, string $meta = ''): string
    {
        try {
            $data = Request::exceptionData($message, $process, $meta);

            return $this->send('exception', $data);
        } catch (HawkFlowException $e) {
            $this->log($e->getMessage());

            return $e->getMessage();
        }
    }

    /**
     * @param array $items
     * @param string $process
     * @param string $meta (optional)
     * @return string
     */
    public function metrics(array $items, string $process, string $meta = ''): string
    {
        try {
            $data = Request::metricsData($items, $process, $meta);

            return $this->send('metrics', $data);
        } catch (HawkFlowException $e) {
            $this->log($e->getMessage());

            return $e->getMessage();
        }
    }

    /**
     * @param string $path
     * @param array $data
     * @return string
     * @throws HawkFlowException
     */
    private function send(string $path, array $data): string
    {
        Validation::validateApiKey($this->apiKey);

        $url = \sprintf('%s/%s', self::URL, $path);
        $content = \json_encode($data);

        $this->log(\sprintf('Requesting url: %s', $url));
        $this->log(\sprintf('Sending data: %s', $content));

        for ($i = $this->maxRetries; $i > 0; $i--) {
            $stream = $this->client->call($url, $this->apiKey, $content);

            if (false === $stream) {
                $this->log(\sprintf('Connection failed on attempt %d', $i));

                continue;
            }

            $headers = $this->client->getHeaders($stream);
            $statusCode = ClientHelper::parseStatusCode($headers);
            $responseBody = $this->client->getBody($stream);

            $this->log(\sprintf('Response Status: %s', $statusCode));
            $this->log(\sprintf('Response Body: %s', $responseBody));

            // Unauthorised access
            if (401 == $statusCode) {
                return $responseBody;
            }

            // Success
            if (201 == $statusCode) {
                return $responseBody;
            }

            $this->log(\sprintf('Unexpected status code %d returned on attempt %d', $statusCode, $i));
        }

        throw new HawkFlowException('Connection failed permanently');
    }

    /**
     * @param mixed $message
     */
    private function log($message)
    {
        if ($this->debug) {
            \var_dump($message);
        }
    }
}
