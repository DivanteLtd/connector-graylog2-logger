<?php

namespace Divante\Connector\Graylog\Monolog;

use Monolog\Handler\GelfHandler as MonologGelfHandler;
use Psr\Log\LoggerInterface;

/**
 * Class GelfHandler
 * @package Divante\Connector\Graylog\Monolog
 */
class GelfHandler extends MonologGelfHandler
{
    /** @var LoggerInterface */
    protected $fallbackLogger;

    /**
     * @param LoggerInterface $logger
     */
    public function addFallbackLogger(LoggerInterface $logger)
    {
        $this->fallbackLogger = $logger;
    }

    /**
     * @param array $record
     */
    public function write(array $record)
    {
        try {
            $this->publisher->publish($record['formatted']);
        } catch (\RuntimeException $runtimeException) {
            $this->fallbackLogger->critical($runtimeException->getMessage());
        }
    }
}
