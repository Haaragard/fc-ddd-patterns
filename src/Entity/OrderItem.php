<?php declare(strict_types=1);

namespace App\Entity;

class OrderItem
{
    public function __construct(
        private string $id,
        private string $productId,
        private string $name,
        private int $quantity,
        private int $price
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

    private function validate(): void
    {
        if (empty($this->id)) {
            throw new \Exception('Id is required');
        }

        if (empty($this->productId)) {
            throw new \Exception('Product Id is required');
        }

        if (empty($this->name)) {
            throw new \Exception('Name is required');
        }

        if ($this->quantity <= 0) {
            throw new \Exception('Quantity must be greater than zero');
        }

        if ($this->price <= 0) {
            throw new \Exception('Price must be greater than zero');
        }
    }
}