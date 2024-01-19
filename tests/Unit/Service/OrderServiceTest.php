<?php

namespace Tests\Unit\Service;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Service\OrderService;
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
}
