<?php declare(strict_types=1);

namespace App\Domain\Entity;

use Exception;

class Order extends BaseEntity
{
    /**
     * @param string $id
     * @param string $customerId
     * @param array<int, OrderItem> $items
     * @throws Exception
     */
    public function __construct(
        private ?string $id = null,
        private string $customerId,
        private array $items
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
