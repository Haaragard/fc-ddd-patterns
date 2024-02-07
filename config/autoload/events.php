<?php declare(strict_types=1);

return [
    \App\Domain\Customer\Event\CustomerCreatedEvent::class => [
        \App\Domain\Customer\Event\Handler\SendFirstConsoleLogEventHandler::class,
        \App\Domain\Customer\Event\Handler\SendSecondConsoleLogEventHandler::class,
    ],
    \App\Domain\Customer\Event\AddressChangedEvent::class => [
        \App\Domain\Customer\Event\Handler\SendAddressChangedConsoleLogEventHandler::class,
    ],
];
