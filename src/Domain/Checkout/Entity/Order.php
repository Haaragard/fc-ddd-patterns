<?php declare(strict_types=1);

namespace App\Domain\Checkout\Entity;

use App\Domain\Customer\Entity\Customer;
use App\Domain\Shared\Entity\BaseEntity;
use Exception;

class Order extends BaseEntity
{
    /**
     * @param string|null $id
     * @param Customer $customer
     * @param array<int, OrderItem> $items
     * @throws Exception
     */
    public function __construct(
        private ?string $id = null,
        private Customer $customer,
        private array $items
    )
    {
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

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
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
        if (empty($this->items)) {
            throw new Exception('Items are required');
        }
    }
}
