<?php

namespace App\Domain\Event\Shared;

interface EventHandlerInterface
{
    public function handle(EventInterface $event): void;
}
