<?php declare(strict_types=1);

namespace App\Entity;

class OrderItem
{
    public function __construct(
        private string $id,
        private string $name,
        private int $quantity,
        private int $price
    ) {}

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
}