<?php

namespace App\Application\Event;

use App\Domain\Shared\Enums\EventEnum;
use DateTimeImmutable;

class EventAbstract implements EventInterface
{
    protected EventEnum $name;
    protected ?DateTimeImmutable $dateTimeOccurred;

    public function __construct(protected mixed $eventData = null)
    {
        $this->dateTimeOccurred = new DateTimeImmutable();
    }

    public function getName(): string
    {
        return $this->name->value;
    }

    public function getDateTimeOccurred(): DateTimeImmutable
    {
        return $this->dateTimeOccurred;
    }

    public function getEventData(): mixed
    {
        return $this->eventData;
    }
}
