<?php

namespace App\Application\Event;

class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var array<string, EventHandlerInterface[]>
     */
    private array $eventHandlers = [];

    /**
     * @inheritDoc
     */
    public function getEventHandlers(string $eventName): array
    {
        return $this->eventHandlers[$eventName] ?? [];
    }

    public function register(string $eventName, EventHandlerInterface $eventHandler): void
    {
        if (!array_key_exists($eventName, $this->eventHandlers)) {
            $this->eventHandlers[$eventName] = [];
        }

        if (!in_array($eventHandler, $this->eventHandlers[$eventName])) {
            $this->eventHandlers[$eventName][] = $eventHandler;
        }
    }

    public function unregister(string $eventName, EventHandlerInterface $eventHandler): void
    {
        if (!array_key_exists($eventName, $this->eventHandlers)) {
            return;
        }

        $index = array_search($eventHandler, $this->eventHandlers[$eventName]);

        if (is_bool($index)) {
            return;
        }

        array_splice(
            $this->eventHandlers[$eventName],
            $index,
            1
        );
    }

    public function unregisterAll(): void
    {
        $this->eventHandlers = [];
    }

    public function notify(EventInterface $event): void
    {
        $handlers = $this->eventHandlers[$event->getName()] ?? [];

        foreach ($handlers as $handler) {
            $handler->handle($event);
        }
    }
}
