<?php

namespace App\Domain\Event\Shared;

use DateTimeImmutable;

interface EventInterface
{
    public function getName(): string;
    public function getDateTimeOccurred(): DateTimeImmutable;
    public function getEventData(): mixed;
}
