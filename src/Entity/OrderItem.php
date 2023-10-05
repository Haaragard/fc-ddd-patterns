<?php declare(strict_types=1);

namespace App\Entity;

class OrderItem
{
    public function __construct(
        private string $id,
        private string $name,
        private int $price
    ) {}

    public function getPrice(): int
    {
        return $this->price;
    }
}