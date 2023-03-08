<?php

namespace HawkFlow\HawkFlow;

/**
 * Static Class Validation
 */
class Request
{
    /**
     * @param string $process
     * @param string $meta (optional)
     * @param string $uid (optional)
     * @return array
     * @throws HawkFlowException
     */
    public static function timedData(string $process, string $meta = '', string $uid = ''): array
    {
        Validation::validateTimedData($process, $meta, $uid);

        $data = [
            'process' => $process,
        ];
        if ( ! empty($meta)) {
            $data['meta'] = $meta;
        }
        if ( ! empty($uid)) {
            $data['uid'] = $uid;
        }

        return $data;
    }

    /**
     * @param string $message
     * @param string $process
     * @param string $meta (optional)
     * @return array
     * @throws HawkFlowException
     */
    public static function exceptionData(string $message, string $process, string $meta = ''): array
    {
        Validation::validateException($message, $process, $meta);

        $data = [
            'exception' => $message,
            'process' => $process,
        ];
        if ( ! empty($meta)) {
            $data['meta'] = $meta;
        }

        return $data;
    }

    /**
     * @param array $items
     * @param string $process
     * @param string $meta (optional)
     * @return array
     * @throws HawkFlowException
     */
    public static function metricsData(array $items, string $process, string $meta = ''): array
    {
        Validation::validateMetrics($items, $process, $meta);

        $data = [
            'items' => $items,
            'process' => $process,
        ];
        if ( ! empty($meta)) {
            $data['meta'] = $meta;
        }

        return $data;
    }
}
