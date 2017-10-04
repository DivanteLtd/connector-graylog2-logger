<?php

namespace Divante\Tests\Graylog\Fixture;

use Divante\Connector\Graylog\Logger\GraylogLoggableEntity;

/**
 * Class Entity
 * @package Divante\Tests\Graylog\Fixture
 */
class Entity implements GraylogLoggableEntity
{
    private $id;
    private $details;

    /**
     * @return mixed
     */
    public function getRequestDetails()
    {
        return $this->details;
    }

    /**
     * @return mixed
     */
    public function getObjectId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setObjectId($id)
    {
        $this->id = $id;
    }

    /**
     * @param array $details
     */
    public function setRequestDetails($details = [])
    {
        $this->details = $details;
    }
}
