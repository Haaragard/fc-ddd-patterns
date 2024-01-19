<?php declare(strict_types=1);

namespace App\Entity;

use Exception;

class Customer
{
    private ?Address $address = null;
    private int $rewardPoints = 0;

    /**
     * @throws Exception
     */
    public function __construct(
        private readonly string $id,
        private string $name,
        private bool $active = true
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

    /**
     * @throws Exception
     */
    public function activate(): void
    {
        if (is_null($this->address)) {
            throw new Exception('Address is mandatory to activate a customer');
        }

        $this->active = true;
    }

    public function deactivate(): void
    {
        $this->active = false;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getRewardPoints(): int
    {
        return $this->rewardPoints;
    }

    /**
     * @throws Exception
     */
    public function addRewardPoints(int $value): void
    {
        if ($value <= 0) {
            throw new Exception('Cannot add zero or negative reward points');
        }

        $this->rewardPoints += $value;
    }

    /**
     * @throws Exception
     */
    private function validate(): void
    {
        if (empty($this->id)) {
            throw new Exception("Id is required");
        }

        if (empty($this->name)) {
            throw new Exception("Name is required");
        }
    }
}
