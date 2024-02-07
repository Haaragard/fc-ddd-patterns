<?php

namespace App\Application\Event;

interface EventHandlerInterface
{
    public function handle(EventInterface $event): void;
}
