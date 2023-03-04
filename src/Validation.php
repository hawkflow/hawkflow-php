<?php

namespace HawkFlow\HawkFlow;

/**
 * Static Class Validation
 */
class Validation
{
    /**
     * @param string $apiKey
     * @throws HawkFlowException
     */
    public static function validateApiKey(string $apiKey)
    {
        if (empty($apiKey)) {
            throw new HawkFlowException('No API Key set.');
        }

        if (strlen($apiKey) > 50) {
            throw new HawkFlowException('Invalid API Key format.');
        }

        if ( ! preg_match('/^[a-zA-Z\d\s_-]*$/', $apiKey)) {
            throw new HawkFlowException('Invalid API Key format.');
        }
    }

    /**
     * @param string $process
     * @param string $meta
     * @param string $uid
     * @throws HawkFlowException
     */
    public static function validateTimedData(string $process, string $meta, string $uid)
    {
        self::validateProcess($process);
        self::validateMeta($meta);
        self::validateUID($uid);
    }

    /**
     * @param string $message
     * @param string $process
     * @param string $meta
     * @throws HawkFlowException
     */
    public static function validateException(string $message, string $process, string $meta)
    {
        self::validateExceptionMessage($message);
        self::validateProcess($process);
        self::validateMeta($meta);
    }

    /**
     * @param array $items
     * @param string $process
     * @param string $meta
     * @throws HawkFlowException
     */
    public static function validateMetrics(array $items, string $process, string $meta)
    {
        self::validateMetricsItems($items);
        self::validateProcess($process);
        self::validateMeta($meta);
    }

    /**
     * @param string $process
     * @throws HawkFlowException
     */
    public static function validateProcess(string $process)
    {
        if (empty($process)) {
            throw new HawkFlowException('No process set.');
        }

        if (strlen($process) > 250) {
            throw new HawkFlowException('Process parameter exceeded max length of 250 characters.');
        }

        if ( ! preg_match('/^[a-zA-Z\d\s_-]*$/', $process)) {
            throw new HawkFlowException('Process parameter contains unsupported characters.');
        }
    }

    /**
     * @param string $meta
     * @throws HawkFlowException
     */
    public static function validateMeta(string $meta)
    {
        if (strlen($meta) > 500) {
            throw new HawkFlowException('Meta parameter exceeded max length of 500 characters.');
        }

        if ( ! preg_match('/^[a-zA-Z\d\s_-]*$/', $meta)) {
            throw new HawkFlowException('Meta parameter contains unsupported characters.');
        }
    }

    /**
     * @param string $uid
     * @throws HawkFlowException
     */
    public static function validateUID(string $uid)
    {
        if (strlen($uid) > 50) {
            throw new HawkFlowException('UID parameter exceeded max length of 50 characters.');
        }

        if ( ! preg_match('/^[a-zA-Z\d\s_-]*$/', $uid)) {
            throw new HawkFlowException('UID parameter contains unsupported characters.');
        }
    }

    /**
     * @param string $message
     * @throws HawkFlowException
     */
    public static function validateExceptionMessage(string $message)
    {
        if (strlen($message) > 15000) {
            throw new HawkFlowException('ExceptionMessage parameter exceeded max length of 15000 characters.');
        }
    }

    /**
     * @param array $items
     * @throws HawkFlowException
     */
    public static function validateMetricsItems(array $items)
    {
        if (empty($items)) {
            throw new HawkFlowException('No items set.');
        }

        foreach($items as $k => $v) {
            if (strlen($k) > 50) {
                throw new HawkFlowException(\sprintf('Item key %s exceeded max length of 50 characters.', $k));
            }
            if ( ! is_int($v) && ! is_float($v)) {
                throw new HawkFlowException(\sprintf('Value of item %s is not int or float.', $k));
            }
        }
    }
}
