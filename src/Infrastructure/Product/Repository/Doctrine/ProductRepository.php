<?php

namespace App\Infrastructure\Product\Repository\Doctrine;

use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Product\Model\Doctrine\Product;
use App\Infrastructure\Shared\Repository\Repository;

class ProductRepository extends Repository implements ProductRepositoryInterface
{
    protected string $model = Product::class;
}
