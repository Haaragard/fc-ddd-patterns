<?php declare(strict_types=1);

namespace Tests\Unit\Entity;

use App\Entity\Order;
use App\Entity\OrderItem;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function test_should_throw_error_when_id_is_empty(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Id is required');

        // Arrange

        $orderItem1 = new OrderItem(
            id: '1',
            name: 'Order Item 1',
            quantity: 1,
            price: 100
        );


        // Act
        new Order(
            '',
            '123',
            [$orderItem1],
        );

        // Assert
    }

    public function test_should_throw_error_when_customer_id_is_empty(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Customer Id is required');

        // Arrange
        $orderItem1 = new OrderItem(
            id: '1',
            name: 'Order Item 1',
            quantity: 1,
            price: 100
        );

        // Act
        new Order(
            '1',
            '',
            [$orderItem1],
        );

        // Assert
    }

    public function test_should_throw_error_when_order_items_are_empty(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Items are required');

        // Arrange

        // Act
        new Order(
            '1',
            '123',
            [],
        );

        // Assert
    }

    public function test_should_calculate_total(): void
    {
        // Arrange
        $orderItem1 = new OrderItem(
            id: '1',
            name: 'Order Item 1',
            quantity: 3,
            price: 100
        );

        $orderItem2 = new OrderItem(
            id: '2',
            name: 'Order Item 2',
            quantity: 2,
            price: 200
        );

        // Act
        $order = new Order(
            '1',
            '123',
            [$orderItem1, $orderItem2],
        );

        // Assert
        $this->assertEquals(700, $order->total());
    }
}