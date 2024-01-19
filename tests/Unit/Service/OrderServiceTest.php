<?php

namespace Tests\Unit\Service;

use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Service\OrderService;
use Exception;
use PHPUnit\Framework\TestCase;

class OrderServiceTest extends TestCase
{
    private OrderService $orderService;

    public function setUp(): void
    {
        $this->orderService = new OrderService;
    }

    public function test_should_total_of_all_orders(): void
    {
        $orderItem1 = new OrderItem('i1', 'Item 1', 'Item 1', 1, 100);
        $orderItem2 = new OrderItem('i2', 'Item 2', 'Item 2', 2, 200);

        $order1 = new Order('o1', 'Order 1', [$orderItem1]);
        $order2 = new Order('o2', 'Order 2', [$orderItem2]);

        $total = $this->orderService->total([$order1, $order2]);

        $this->assertEquals(500, $total);
    }

    public function test_should_place_an_order(): void
    {
        $customer = new Customer('c1', 'Customer 1');
        $item1 = new OrderItem('i1', 'Item 1', 'Item 1', 1, 10);

        $order = $this->orderService->placeOrder($customer, [$item1]);

        $this->assertEquals(5, $customer->getRewardPoints());
        $this->assertEquals(10, $order->total());
    }

    public function test_should_throw_an_error_when_place_an_order_receives_empty_order_items(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Order must have at least one item');

        $customer = new Customer('c1', 'Customer 1');

        $this->orderService->placeOrder($customer, []);
    }
}
