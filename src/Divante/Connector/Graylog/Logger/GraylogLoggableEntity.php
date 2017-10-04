<?php

namespace Divante\Connector\Graylog\Logger;

interface GraylogLoggableEntity
{
    public function getRequestDetails();
    public function getObjectId();
}
