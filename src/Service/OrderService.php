<?php

namespace App\Service;

use App\Entity\Order;

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
            fn(int $carry, Order $item) => $carry + $item->total(),
            0
        );
    }
}
