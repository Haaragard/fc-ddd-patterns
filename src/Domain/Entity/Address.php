<?php declare(strict_types=1);

namespace App\Domain\Entity;
use Exception;

readonly class Address
{
    /**
     * @throws Exception
     */
    public function __construct(
        private string $street,
        private int $number,
        private string $zip,
        private string $city
    ) {
        $this->validate();
    }

    /**
     * @throws Exception
     */
    private function validate(): void
    {
        if (empty($this->street)) {
            throw new Exception("Street is required");
        }

        if (empty($this->number)) {
            throw new Exception("Number is required");
        }

        if (empty($this->zip)) {
            throw new Exception("Zip code is required");
        }

        if (empty($this->city)) {
            throw new Exception("City is required");
        }
    }
}
