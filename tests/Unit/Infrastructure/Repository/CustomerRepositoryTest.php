<?php declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Repository;

use App\Domain\Entity\Address;
use App\Domain\Entity\Customer;
use App\Domain\Repository\CustomerRepositoryInterface;
use App\Infrastructure\Repository\CustomerRepository;
use Tests\DatabaseTestCase;

class CustomerRepositoryTest extends DatabaseTestCase
{
    private CustomerRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new CustomerRepository($this->getEntityManager());
    }

    public function test_should_create_a_customer(): void
    {
        $customer = new Customer(
            id: null,
            name: 'Customer 1'
        );
        $address = new Address(
            'Street 1',
            1,
            '123123',
            'Fake City'
        );
        $customer->setAddress($address);

        $this->repository->create($customer);

        $this->assertNotNull($customer->getId());
    }

    public function test_should_update_a_customer(): void
    {
        $customer = new Customer(
            id: null,
            name: 'Customer 1'
        );
        $address = new Address(
            'Street 1',
            1,
            '123123',
            'Fake City'
        );
        $customer->setAddress($address);

        $this->repository->create($customer);

        $customer->changeName('Customer 1 New Name');

        $this->repository->update($customer);

        $updatedCustomer = $this->repository->find($customer->getId());

        $this->assertEquals($updatedCustomer->toArray(), $customer->toArray());
    }

    public function test_should_find_a_customer(): void
    {
        $customer = new Customer(
            id: null,
            name: 'Customer 1'
        );
        $address = new Address(
            'Street 1',
            1,
            '123123',
            'Fake City'
        );
        $customer->setAddress($address);

        $this->repository->create($customer);

        $customerFound = $this->repository->find($customer->getId());

        $this->assertEquals($customerFound->toArray(), $customer->toArray());
    }

    public function test_should_find_all_customers(): void
    {
        $customer = new Customer(
            id: null,
            name: 'Customer 1'
        );
        $address = new Address(
            'Street 1',
            1,
            '123123',
            'Fake City'
        );
        $customer->setAddress($address);

        $customer2 = new Customer(
            id: null,
            name: 'Customer 2'
        );
        $address2 = new Address(
            'Street 2',
            2,
            '123123',
            'Fake City'
        );
        $customer2->setAddress($address2);

        $this->repository->create($customer);
        $this->repository->create($customer2);

        $allCustomers = $this->repository->findAll();

        $this->assertEquals(
            array_map(fn (Customer $customer) => $customer->toArray(), $allCustomers),
            [$customer->toArray(), $customer2->toArray()]
        );
    }
}
