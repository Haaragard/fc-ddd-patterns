<?php

namespace App\Domain\Product\Factory;

use App\Domain\Product\Entity\Product;
use App\Domain\Shared\Entity\BaseEntity;
use App\Domain\Shared\Factory\BaseFactory;
use Ramsey\Uuid\Uuid;

class ProductFactory extends BaseFactory
{
    public static function create(array $data = []): BaseEntity|Product
    {
        return new Product(
            id: $data['id'] ?? (string) Uuid::uuid4(),
            name: $data['name'] ?? 'Product Name 1',
            price: $data['price'] ?? 100
        );
    }
}
