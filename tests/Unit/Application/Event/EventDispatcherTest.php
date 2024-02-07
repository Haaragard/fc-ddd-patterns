<?php

namespace Tests\Unit\Domain\Shared\Event;

use App\Application\Event\EventDispatcher;
use App\Application\Event\EventDispatcherInterface;
use App\Application\Event\EventHandlerInterface;
use App\Application\Event\EventInterface;
use Tests\TestCase;

class EventDispatcherTest extends TestCase
{
    private EventDispatcherInterface $eventDispatcher;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eventDispatcher = new EventDispatcher();
    }

    /**
     * @test
     */
    public function should_get_event_handlers_from_event_name(): void
    {
        $eventHandler = $this->createMock(EventHandlerInterface::class);

        $this->eventDispatcher->register('DoSomethingEvent', $eventHandler);

        $this->assertNotEmpty($this->eventDispatcher->getEventHandlers('DoSomethingEvent'));
        $this->assertCount(1, $this->eventDispatcher->getEventHandlers('DoSomethingEvent'));
    }

    /**
     * @test
     */
    public function should_get_event_handlers_from_non_existent_event_name(): void
    {
        $this->assertEmpty($this->eventDispatcher->getEventHandlers('DoSomethingEvent'));
        $this->assertCount(0, $this->eventDispatcher->getEventHandlers('DoSomethingEvent'));
    }

    /**
     * @test
     */
    public function should_register_an_event_handler(): void
    {
        $eventHandler = $this->createMock(EventHandlerInterface::class);

        $this->eventDispatcher->register('DoSomethingEvent', $eventHandler);

        $this->assertNotEmpty($this->eventDispatcher->getEventHandlers('DoSomethingEvent'));
        $this->assertCount(1, $this->eventDispatcher->getEventHandlers('DoSomethingEvent'));
    }

    /**
     * @test
     */
    public function should_unregister_an_event(): void
    {
        $eventHandler = $this->createMock(EventHandlerInterface::class);

        $this->eventDispatcher->register('DoSomethingEvent', $eventHandler);

        $this->assertNotEmpty($this->eventDispatcher->getEventHandlers('DoSomethingEvent'));
        $this->assertCount(1, $this->eventDispatcher->getEventHandlers('DoSomethingEvent'));

        $this->eventDispatcher->unregister('DoSomethingEvent', $eventHandler);

        var_dump($this->eventDispatcher->getEventHandlers('DoSomethingEvent'));

        $this->assertEmpty($this->eventDispatcher->getEventHandlers('DoSomethingEvent'));
        $this->assertCount(0, $this->eventDispatcher->getEventHandlers('DoSomethingEvent'));
    }

    /**
     * @test
     */
    public function should_unregister_all_events(): void
    {
        $eventHandler = $this->createMock(EventHandlerInterface::class);

        $this->eventDispatcher->register('DoSomethingEvent', $eventHandler);

        $this->assertNotEmpty($this->eventDispatcher->getEventHandlers('DoSomethingEvent'));
        $this->assertCount(1, $this->eventDispatcher->getEventHandlers('DoSomethingEvent'));

        $this->eventDispatcher->unregisterAll();

        $this->assertEmpty($this->eventDispatcher->getEventHandlers('DoSomethingEvent'));
        $this->assertCount(0, $this->eventDispatcher->getEventHandlers('DoSomethingEvent'));
    }

    /**
     * @test
     */
    public function should_notify(): void
    {
        $eventHandler = $this->createMock(EventHandlerInterface::class);
        $eventHandler->expects($this->once())
            ->method('handle');
        $event = $this->createMock(EventInterface::class);

        $this->eventDispatcher->register($event->getName(), $eventHandler);
        $this->eventDispatcher->notify($event);
    }
}
