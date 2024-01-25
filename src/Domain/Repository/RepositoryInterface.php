<?php

namespace App\Domain\Repository;

use App\Domain\Entity\BaseEntity;

interface RepositoryInterface
{
    public function create(BaseEntity $entity): void;
    public function update(BaseEntity $entity): void;
    public function find(mixed $id): BaseEntity;

    /**
     * @return BaseEntity[]
     */
    public function findAll(): array;
}
