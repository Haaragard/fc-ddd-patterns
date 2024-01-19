<?php declare(strict_types=1);

namespace App\Entity;

use Exception;

class Product
{
    /**
     * @throws Exception
     */
    public function __construct(
        private readonly string $id,
        private string $name,
        private int $price
    ) {
        $this->validate();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
    }

    public function changePrice(int $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @throws Exception
     */
    private function validate(): void
    {
        if (empty($this->id)) {
            throw new Exception('Id is required');
        }

        if (empty($this->name)) {
            throw new Exception('Name is required');
        }

        if ($this->price <= 0) {
            throw new Exception('Price must be greater than zero');
        }
    }
}
