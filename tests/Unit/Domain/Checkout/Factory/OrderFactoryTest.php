<?php

namespace Tests\Unit\Domain\Checkout\Factory;

use App\Domain\Checkout\Entity\Order;
use App\Domain\Checkout\Factory\OrderFactory;
use App\Domain\Checkout\Factory\OrderItemFactory;
use App\Domain\Customer\Factory\CustomerFactory;
use Tests\TestCase;

class OrderFactoryTest extends TestCase
{
    /**
     * @dataProvider orderDataProvider
     */
    public function test_should_create_order_with_factory(array $data): void
    {
        $order = OrderFactory::create($data);

        $this->assertInstanceOf(Order::class, $order);
    }

    public static function orderDataProvider(): array
    {
        return [
            [[]], // Can create empty
            [['id' => 'fakeId']], // Can create with id
            [[
                'id' => 'fakeId',
                'customer' => CustomerFactory::create(),
            ]], // Can create with id|customer
            [[
                'id' => 'fakeId',
                'customer' => CustomerFactory::create(),
                'order_items' => [
                    OrderItemFactory::create(),
                ],
            ]], // Can create with id|customer|order_items
            [[
                'id' => 'fakeId',
                'customer' => CustomerFactory::create(),
                'order_items' => [
                    OrderItemFactory::create(),
                    OrderItemFactory::create(),
                    OrderItemFactory::create(),
                    OrderItemFactory::create(),
                    OrderItemFactory::create(),
                ],
            ]], // Can create with id|customer|order_items, many items
        ];
    }
}
