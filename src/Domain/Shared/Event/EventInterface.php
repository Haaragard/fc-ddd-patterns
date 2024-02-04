<?php

namespace App\Domain\Shared\Event;

use DateTimeImmutable;

interface EventInterface
{
    public function getName(): string;
    public function getDateTimeOccurred(): DateTimeImmutable;
    public function getEventData(): mixed;
}
