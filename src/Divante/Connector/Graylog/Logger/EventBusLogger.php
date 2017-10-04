<?php

namespace Divante\Connector\Graylog\Logger;

use Psr\Log\LoggerInterface;

class EventBusLogger
{
    /** @var LoggerInterface */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function info(GraylogLoggableEntity $entity)
    {
        $this->logger->info(sprintf("%s id %s properly published on event bus. Request details %s",
            get_class($entity), $entity->getObjectId(), json_encode($entity->getRequestDetails())));
    }

    public function critical(GraylogLoggableEntity $entity, $lastErrorHandler = null)
    {
        $lastErrorHandler = $lastErrorHandler ? $lastErrorHandler : error_get_last();
        $this->logger->critical(sprintf("%s id %s is not sent to event bus. Request details %s. Error %s",
            get_class($entity), $entity->getObjectId(), json_encode($entity->getRequestDetails()), $lastErrorHandler['message']));
    }
}
