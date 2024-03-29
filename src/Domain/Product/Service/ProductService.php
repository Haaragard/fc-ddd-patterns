<?php

namespace App\Domain\Product\Service;

use App\Domain\Product\Entity\Product;

class ProductService
{
    /**
     * @param array<int, Product> $products
     * @param int $percentage
     * @return void
     */
    public function increasePrice(array $products, int $percentage): void
    {
        foreach ($products as $product) {
            $product->changePrice(($product->getPrice() * $percentage)/100 + $product->getPrice());
        }
    }
}
