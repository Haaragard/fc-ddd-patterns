<?php

namespace Tests\Unit\Domain\Product\Factory;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\Factory\ProductFactory;
use Tests\TestCase;

class ProductFactoryTest extends TestCase
{
    /**
     * @dataProvider productDataProvider
     */
    public function test_should_create_product_with_factory(array $data): void
    {
        $product = ProductFactory::create($data);

        $this->assertInstanceOf(Product::class, $product);
    }

    public static function productDataProvider(): array
    {
        return [
            [[]], // Can create empty
            [['id' => 'fakeId']], // Can create with id
            [[
                'id' => 'fakeId',
                'name' => 'fakeName',
            ]], // Can create with id|name
            [[
                'id' => 'fakeId',
                'name' => 'fakeName',
                'price' => 123,
            ]], // Can create with id|name|price
        ];
    }
}
