<?php declare(strict_types=1);

namespace App\Entity;

use Exception;

class OrderItem
{
    /**
     * @throws Exception
     */
    public function __construct(
        private readonly string $id,
        private readonly string $productId,
        private readonly string $name,
        private readonly int    $quantity,
        private readonly int $price
    ) {
        $this->validate();
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getTotalPrice(): int
    {
        return $this->getQuantity() * $this->getPrice();
    }

    /**
     * @throws Exception
     */
    private function validate(): void
    {
        if (empty($this->id)) {
            throw new Exception('Id is required');
        }

        if (empty($this->productId)) {
            throw new Exception('Product Id is required');
        }

        if (empty($this->name)) {
            throw new Exception('Name is required');
        }

        if ($this->quantity <= 0) {
            throw new Exception('Quantity must be greater than zero');
        }

        if ($this->price <= 0) {
            throw new Exception('Price must be greater than zero');
        }
    }
}
