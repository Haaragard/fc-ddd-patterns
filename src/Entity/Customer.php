<?php declare(strict_types=1);

namespace App\Entity;

use Exception;

class Customer
{
    private ?Address $address = null;

    public function __construct(
        private string $id,
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