<?php

namespace App\Domain\Checkout\Factory;

use App\Domain\Checkout\Entity\OrderItem;
use App\Domain\Product\Entity\Product;
use App\Domain\Product\Factory\ProductFactory;
use App\Domain\Shared\Entity\BaseEntity;
use App\Domain\Shared\Factory\BaseFactory;
use Ramsey\Uuid\Uuid;

class OrderItemFactory extends BaseFactory
{

    static function create(array $data = []): BaseEntity|OrderItem
    {
        $product = $data['product'];
        if (!($product instanceof Product)) {
            $productData = [
                'id' => $product['id'] ?? (string) Uuid::uuid4(),
                'name' => $product['name'] ?? $data['name'] ?? 'Product Name 1',
                'price' => $product['price'] ?? $data['price'] ?? 100,
            ];

            $product = ProductFactory::create($productData);
        }

        return new OrderItem(
            id: $data['id'] ?? (string) Uuid::uuid4(),
            product: $product,
            name: $productData['name'] ?? 'Product Name 1',
            quantity: $data['quantity'] ?? 1,
            price: $productData['price'] ?? 100
        );
    }
}
