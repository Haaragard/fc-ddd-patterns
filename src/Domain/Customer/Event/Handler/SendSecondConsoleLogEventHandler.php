<?php

namespace App\Domain\Customer\Event\Handler;

use App\Application\Event\EventHandlerInterface;
use App\Application\Event\EventInterface;

class SendSecondConsoleLogEventHandler implements EventHandlerInterface
{
    public function handle(EventInterface $event): void
    {
        echo sprintf('Esse é o segundo log do evento %s', get_class($event));
    }
}
