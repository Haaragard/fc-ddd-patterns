<?php

namespace App\Infrastructure\Shared\Model;

use App\Domain\Shared\Entity\BaseEntity;

abstract class BaseModel
{
    public string $entity = BaseEntity::class;

    abstract public function map(BaseEntity $entity): void;
    abstract public function mapToEntity(): BaseEntity;
}
