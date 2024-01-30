<?php

namespace Tests\Unit\Domain\Service;

use App\Domain\Entity\Customer;
use App\Domain\Entity\Order;
use App\Domain\Entity\OrderItem;
use App\Domain\Entity\Product;
use App\Domain\Service\OrderService;
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
        $product1 = new Product('p1', 'produt 1', 100);
        $product2 = new Product('p2', 'product 2', 200);

        $orderItem1 = new OrderItem('i1', $product1, $product1->getName(), 1, $product1->getPrice());
        $orderItem2 = new OrderItem('i2', $product2, $product2->getName(), 2, $product2->getPrice());

        $customer = new Customer('c1', 'customer 1', true);

        $order1 = new Order('o1', $customer, [$orderItem1]);
        $order2 = new Order('o2', $customer, [$orderItem2]);

        $total = $this->orderService->total([$order1, $order2]);

        $this->assertEquals(500, $total);
    }

    public function test_should_place_an_order(): void
    {
        $product = new Product('p1', 'produt 1', 100);
        $item = new OrderItem('i1', $product, $product->getName(), 1, 10);

        $customer = new Customer('c1', 'Customer 1');
        $order = $this->orderService->placeOrder($customer, [$item]);

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
