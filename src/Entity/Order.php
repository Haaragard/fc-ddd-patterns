<?php declare(strict_types=1);

namespace App\Entity;

class Order
{
    /**
     * @param string $id
     * @param string $customerId
     * @param array<int, OrderItem> $items
     */
    public function __construct(
        private string $id,
        private string $customerId,
        private array $items
    ) {}
}