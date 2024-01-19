<?php declare(strict_types=1);

namespace Tests\Unit\Service;

use App\Entity\Product;
use App\Service\ProductService;
use Tests\TestBase;

class ProductServiceTest extends TestBase
{
    private ProductService $productService;

    public function setUp(): void
    {
        $this->productService = new ProductService;
    }

    public function test_should_change_the_prices_of_all_products(): void
    {
        $product1 = new Product('1', 'Product 1', 10);
        $product2 = new Product('2', 'Product 2', 20);
        $products = [$product1, $product2];

        $this->productService->increasePrice($products, 100);

        $this->assertEquals(20, $product1->getPrice());
        $this->assertEquals(40, $product2->getPrice());
    }
}