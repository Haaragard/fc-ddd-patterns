<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\Customer;
use App\Domain\Entity\Order;
use App\Domain\Entity\OrderItem;
use App\Domain\Entity\Product;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function test_should_throw_error_when_order_items_are_empty(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Items are required');

        $customer = new Customer(
            'c1',
            'Customer 1',
            true
        );

        new Order(
            '1',
            $customer,
            [],
        );
    }

    public function test_should_calculate_total(): void
    {
        $product = new Product(
            id: 'p1',
            name: 'product 1',
            price: 10
        );

        $product2 = new Product(
            id: 'p2',
            name: 'product 2',
            price: 20
        );

        $orderItem1 = new OrderItem(
            id: '1',
            product: $product,
            name: 'Order Item 1',
            quantity: 3,
            price: 100
        );

        $orderItem2 = new OrderItem(
            id: '2',
            product: $product2,
            name: 'Order Item 2',
            quantity: 2,
            price: 200
        );

        $customer = new Customer(
            'c1',
            'Customer 1',
            true
        );

        $order = new Order(
            '1',
            $customer,
            [$orderItem1, $orderItem2],
        );

        // Assert
        $this->assertEquals(700, $order->total());
    }
}
