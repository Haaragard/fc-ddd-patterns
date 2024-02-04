<?php declare(strict_types=1);

namespace App\Domain\Checkout\Entity;

use App\Domain\Product\Entity\Product;
use App\Domain\Shared\Entity\BaseEntity;
use Exception;

class OrderItem extends BaseEntity
{
    /**
     * @throws Exception
     */
    public function __construct(
        private ?string $id = null,
        private Product $product,
        private string $name,
        private int $quantity,
        private int $price
    ) {
        $this->validate();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(mixed $id): void
    {
        $this->id = (string) $id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
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
