<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\ProductRepositoryInterface;
use App\Infrastructure\Database\Doctrine\Model\Product;

class ProductRepository extends Repository implements ProductRepositoryInterface
{
    protected string $model = Product::class;
}
