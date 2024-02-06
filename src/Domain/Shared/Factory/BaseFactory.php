<?php

namespace App\Domain\Shared\Factory;

use App\Domain\Shared\Entity\BaseEntity;

abstract class BaseFactory
{
    abstract static function create(array $data = []): BaseEntity;
}
