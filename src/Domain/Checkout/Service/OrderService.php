<?php

namespace App\Domain\Checkout\Service;

use App\Domain\Checkout\Entity\Order;
use App\Domain\Checkout\Entity\OrderItem;
use App\Domain\Customer\Entity\Customer;
use Exception;

class OrderService
{
    /**
     * @param array<int, Order> $orders
     * @return int
     */
    public function total(array $orders): int
    {
        return array_reduce(
            $orders,
            fn(int $carry, Order $order) => $carry + $order->total(),
            0
        );
    }

    /**
     * @param Customer $customer
     * @param array<int, OrderItem> $items
     * @return Order
     * @throws Exception
     */
    public function placeOrder(Customer $customer, array $items): Order
    {
        if (empty($items)) {
            throw new Exception('Order must have at least one item');
        }

        $order = new Order(null, $customer, $items);
        $customer->addRewardPoints($order->total()/2);

        return $order;
    }
}
