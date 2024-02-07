<?php

namespace App\Domain\Customer\Event\Handler;

use App\Application\Event\EventHandlerInterface;
use App\Application\Event\EventInterface;

class SendFirstConsoleLogEventHandler implements EventHandlerInterface
{
    public function handle(EventInterface $event): void
    {
        echo sprintf('Esse é o primeiro log do evento %s', get_class($event));
    }
}
