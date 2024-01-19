<?php declare(strict_types=1);

namespace App\Entity;

use Exception;

class Order
{
    /**
     * @param string $id
     * @param string $customerId
     * @param array<int, OrderItem> $items
     * @throws Exception
     */
    public function __construct(
        private readonly string $id,
        private readonly string $customerId,
        private readonly array $items
    ) {
        $this->validate();
    }

    public function total(): int
    {
        return array_reduce(
            array: $this->items,
            callback: fn (int $carry, OrderItem $item) => $carry + $item->getTotalPrice(),
            initial: 0
        );
    }

    /**
     * @return void
     * @throws Exception
     */
    private function validate(): void
    {
        if (empty($this->id)) {
            throw new Exception('Id is required');
        }

        if (empty($this->customerId)) {
            throw new Exception('Customer Id is required');
        }

        if (empty($this->items)) {
            throw new Exception('Items are required');
        }
    }
}
