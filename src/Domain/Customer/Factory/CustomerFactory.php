<?php

namespace App\Domain\Customer\Factory;

use App\Domain\Customer\Entity\Customer;
use App\Domain\Customer\ValueObject\Address;
use App\Domain\Shared\Entity\BaseEntity;
use App\Domain\Shared\Factory\BaseFactory;
use Ramsey\Uuid\Uuid;

class CustomerFactory extends BaseFactory
{
    static function create(array $data = []): BaseEntity|Customer
    {
        $address = $data['address'];
        if (!($address instanceof Address)) {
            $address = AddressFactory::create($address);
        }

        return new Customer(
            id: $data['id'] ?? (string) Uuid::uuid4(),
            name: $data['name'] ?? 'Customer Name',
            active: $data['active'] ?? true,
            rewardPoints: $data['reward_points'] ?? 0,
            address: $address
        );
    }
}
