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
    ) {
        $this->validate();
    }

    public function total(): int
    {
        return (int) array_reduce(
            array: $this->items,
            callback: fn (int $acumulator, OrderItem $item) => $acumulator + $item->getTotalPrice(),
            initial: 0
        );
    }

    private function validate(): void
    {
        if (empty($this->id)) {
            throw new \Exception('Id is required');
        }

        if (empty($this->customerId)) {
            throw new \Exception('Customer Id is required');
        }

        if (empty($this->items)) {
            throw new \Exception('Items are required');
        }
    }
}