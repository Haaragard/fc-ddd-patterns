<?php declare(strict_types=1);

namespace App\Entity;

class Customer
{
    public function __construct(
        private string $id,
        private string $name,
        private string $address,
        private bool $active = true
    ) { }

    public function changeName(string $name): void
    {
        $this->name = $name;
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function deactivate(): void
    {
        $this->active = false;
    }
}