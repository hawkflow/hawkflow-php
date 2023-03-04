<?php

namespace HawkFlow\HawkFlow;

class HawkFlowException extends \Exception
{
    const DOCS_MESSAGE = 'Please see documentation at https://docs.hawkflow.ai/integration/index.html';

    /**
     * HawkFlowException constructor.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        $message = \sprintf('%s %s', $message, self::DOCS_MESSAGE);

        parent::__construct($message);
    }
}
