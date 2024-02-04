<?php declare(strict_types=1);

namespace App\Domain\Product\Entity;

use App\Domain\Shared\Entity\BaseEntity;
use Exception;

class Product extends BaseEntity
{
    /**
     * @throws Exception
     */
    public function __construct(
        private ?string $id = null,
        private string $name,
        private int $price
    ) {
        $this->validate();
    }

    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
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
        if (empty($this->name)) {
            throw new Exception('Name is required');
        }

        if ($this->price <= 0) {
            throw new Exception('Price must be greater than zero');
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
        ];
    }
}
