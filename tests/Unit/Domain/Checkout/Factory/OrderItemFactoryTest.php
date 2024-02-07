<?php

namespace Tests\Unit\Domain\Checkout\Factory;

use App\Domain\Checkout\Entity\OrderItem;
use App\Domain\Checkout\Factory\OrderItemFactory;
use App\Domain\Product\Factory\ProductFactory;
use Tests\TestCase;

class OrderItemFactoryTest extends TestCase
{
    /**
     * @dataProvider orderItemDataProvider
     */
    public function test_should_create_order_item_with_factory(array $data): void
    {
        $orderItem = OrderItemFactory::create($data);

        $this->assertInstanceOf(OrderItem::class, $orderItem);
    }

    public static function orderItemDataProvider(): array
    {
        return [
            [[]], // Can create empty
            [['id' => 'fakeId']], // Can create with id
            [['id' => 'fakeId', 'name' => 'fakeName']], // Can create with id|name
            [[
                'id' => 'fakeId',
                'name' => 'fakeName',
                'quantity' => 10,
            ]], // Can create with id|name|quantity
            [[
                'id' => 'fakeId',
                'name' => 'fakeName',
                'quantity' => 10,
                'price' => 100,
            ]], // Can create with id|name|quantity|price
            [[
                'id' => 'fakeId',
                'name' => 'fakeName',
                'quantity' => 10,
                'price' => 100,
                'product' => ['id' => 'fakeProductId'],
            ]], // Can create with id|name|quantity|price|product_id
            [[
                'id' => 'fakeId',
                'name' => 'fakeName',
                'quantity' => 10,
                'price' => 100,
                'product' => ProductFactory::create(),
            ]], // Can create with id|name|quantity|price|product
        ];
    }
}
