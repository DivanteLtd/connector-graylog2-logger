<?php

namespace Divante\Tests\Graylog\Logger;

use Divante\Connector\Graylog\Logger\EventBusLogger;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Mockery as m;
use Divante\Tests\Graylog\Fixture\Entity;

/**
 * Class EventBusLoggerTest
 * @package Divante\Tests\Graylog\Logger
 */
class EventBusLoggerTest extends TestCase
{
    /** @var m\Mock */
    private $logger;

    /** @var  EventBusLogger */
    private $eventBusLogger;

    /** @test */
    public function it_should_log_custom_log_info()
    {
        $entity = new Entity();
        $entity->setObjectId(999);
        $entity->setRequestDetails(['foo' => 'bar']);

        $this->logger->shouldReceive('info')->with('Divante\Tests\Graylog\Fixture\Entity id 999 properly published on event bus. Request details {"foo":"bar"}')->once();
        $this->eventBusLogger->info($entity);
    }

    /** @test */
    public function it_should_log_failure_log_info()
    {
        $entity = new Entity();
        $entity->setObjectId(666);
        $entity->setRequestDetails(['foo' => 'bar']);

        $this->logger->shouldReceive('critical')
            ->with('Divante\Tests\Graylog\Fixture\Entity id 666 is not sent to event bus. Request details {"foo":"bar"}. Error SOMETHING BAD HAPPEN!')
            ->once();

        $this->eventBusLogger->critical($entity, ['message' => 'SOMETHING BAD HAPPEN!']);
    }

    /**
     *
     */
    public function setUp()
    {
        $this->logger = m::mock(Logger::class);
        $this->eventBusLogger = new EventBusLogger($this->logger);
    }

    /**
     *
     */
    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }
}
