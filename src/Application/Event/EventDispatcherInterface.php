<?php

namespace App\Application\Event;

interface EventDispatcherInterface
{
    /**
     * @param string $eventName
     * @return array<string, EventHandlerInterface[]>
     */
    public function getEventHandlers(string $eventName): array;
    public function register(string $eventName, EventHandlerInterface $eventHandler): void;
    public function unregister(string $eventName, EventHandlerInterface $eventHandler): void;
    public function unregisterAll(): void;
    public function notify(EventInterface $event): void;

}
