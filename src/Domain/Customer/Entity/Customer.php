<?php declare(strict_types=1);

namespace App\Domain\Customer\Entity;

use App\Domain\Customer\Event\AddressChangedEvent;
use App\Domain\Customer\Event\CustomerCreatedEvent;
use App\Domain\Customer\ValueObject\Address;
use App\Domain\Shared\Entity\BaseEntity;
use Exception;

class Customer extends BaseEntity
{
    /**
     * @throws Exception
     */
    public function __construct(
        private ?string $id = null,
        private string $name,
        private bool $active = true,
        private int $rewardPoints = 0,
        private ?Address $address = null
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

    public function changeAddress(Address $address): void
    {
        $this->address = $address;

        dispatch_event(new AddressChangedEvent([
            'customer' => $this,
        ]));
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

    public function sendCreatedEvents(): void
    {
        dispatch_event(new CustomerCreatedEvent());
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
