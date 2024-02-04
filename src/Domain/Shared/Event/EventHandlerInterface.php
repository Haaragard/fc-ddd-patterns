<?php

namespace App\Domain\Shared\Event;

interface EventHandlerInterface
{
    public function handle(EventInterface $event): void;
}
