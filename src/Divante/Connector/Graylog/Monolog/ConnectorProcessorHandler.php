<?php

namespace Divante\Connector\Graylog\Monolog;

/**
 * Class ConnectorProcessorHandler
 * @package Divante\Connector\Graylog\Monolog
 */
class ConnectorProcessorHandler
{
    /**
     * @var string
     */
    private $facility;

    /**
     * ConnectorProcessorHandler constructor.
     * @param string $facility
     */
    public function __construct($facility = 'event_bus')
    {
        $this->facility = $facility;
    }

    /**
     * @param array $record
     * @return array
     */
    public function processRecord(array $record)
    {
        $record['extra']['application_name'] = 'connector_test_app';
        $record['extra']['source'] = 'connector-test';
        $record['channel'] = $this->facility;

        return $record;
    }
}
