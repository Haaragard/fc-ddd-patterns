<?php

namespace App\Infrastructure\Repository;

use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Database\Doctrine\Model\Product;

class ProductRepository extends Repository implements ProductRepositoryInterface
{
    protected string $model = Product::class;
}
