<?php

namespace Tests\Unit\Domain\Customer\Factory;

use App\Domain\Checkout\Factory\OrderItemFactory;
use App\Domain\Customer\Entity\Customer;
use App\Domain\Customer\Factory\AddressFactory;
use App\Domain\Customer\Factory\CustomerFactory;
use Tests\TestCase;

class CustomerFactoryTest extends TestCase
{
    /**
     * @dataProvider customerDataProvider
     */
    public function test_should_create_customer_with_factory(array $data): void
    {
        $customer = CustomerFactory::create($data);

        $this->assertInstanceOf(Customer::class, $customer);
    }

    public static function customerDataProvider(): array
    {
        return [
            [[]], // Can create empty
            [['id' => 'fakeId']], // Can create with id
            [[
                'id' => 'fakeId',
                'name' => 'fakeName',
            ]], // Can create with id|name
            [[
                'id' => 'fakeId',
                'name' => 'fakeName',
                'active' => true,
            ]], // Can create with id|name|active
            [[
                'id' => 'fakeId',
                'name' => 'fakeName',
                'active' => true,
                'reward_points' => 1000,
            ]], // Can create with id|name|active|reward_points
            [[
                'id' => 'fakeId',
                'name' => 'fakeName',
                'active' => true,
                'reward_points' => 1000,
                'address' => AddressFactory::create(),
            ]], // Can create with id|name|active|reward_points|address
        ];
    }
}
