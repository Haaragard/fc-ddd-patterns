<?php

namespace App\Domain\Customer\Factory;

use App\Domain\Customer\ValueObject\Address;
use App\Domain\Shared\Entity\BaseEntity;
use App\Domain\Shared\Factory\BaseFactory;

class AddressFactory extends BaseFactory
{

    static function create(array $data = []): BaseEntity|Address
    {
        return new Address(
            street: $data['street'] ?? 'Street Name',
            number: $data['number'] ?? 123,
            zip: $data['zip'] ?? '1233030',
            city: $data['city'] ?? 'FakeCity'
        );
    }
}
