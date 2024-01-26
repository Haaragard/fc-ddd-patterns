<?php declare(strict_types=1);

namespace App\Domain\Entity;

use Exception;

class Customer extends BaseEntity
{
    private ?Address $address = null;
    private int $rewardPoints = 0;

    /**
     * @throws Exception
     */
    public function __construct(
        private ?string $id = null,
        private string $name,
        private bool $active = true
    ) {
        $this->validate();
    }

    public function getId(): mixed
    {
        return $this->id;
    }

    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getRewardPoints(): int
    {
        return $this->rewardPoints;
    }

    public function setRewardPoints(int $rewardPoints): void
    {
        $this->rewardPoints = $rewardPoints;
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
        if (empty($this->name)) {
            throw new Exception("Name is required");
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'address' => $this->getAddress()->toArray(),
            'active' => $this->getActive(),
            'reward_points' => $this->getRewardPoints(),
        ];
    }
}
