<?php declare(strict_types=1);

namespace App\Domain\Entity;

abstract class BaseEntity
{
    public function getId(): mixed
    {
        return null;
    }

    public function setId(mixed $id): void
    {
        //
    }

    public function toArray(): array
    {
        return [];
    }
}
