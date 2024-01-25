<?php

namespace App\Infrastructure\Database;

use App\Domain\Entity\BaseEntity;

abstract class BaseModel
{
    public string $entity = BaseEntity::class;

    abstract public function map(BaseEntity $entity): void;
    abstract public function mapToEntity(): BaseEntity;
}
