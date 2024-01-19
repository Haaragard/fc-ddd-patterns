<?php declare(strict_types=1);

namespace Tests\Unit\Entity;

use App\Entity\Address;
use App\Entity\Customer;
use Exception;
use PHPUnit\Framework\TestCase;

final class CustomerTest extends TestCase
{
    public function test_should_throw_error_when_id_is_empty(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Id is required');

        //Arrange

        //Act
        new Customer(
            id: '',
            name: 'Name'
        );

        //Assert
    }

    public function test_should_throw_error_when_name_is_empty(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Name is required');

        //Arrange

        //Act
        new Customer(
            id: '123',
            name: ''
        );

        //Assert
    }

    public function test_should_change_name(): void
    {
        //Arrange
        $customer = new Customer(
            id: '123',
            name: 'John'
        );

        //Act
        $customer->changeName('Jane');

        //Assert
        $this->assertNotEquals('Jhon', $customer->getName());
        $this->assertEquals('Jane', $customer->getName());
    }

    public function test_should_throw_error_when_trying_to_activate_customer_without_address(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Address is mandatory to activate a customer');
        $customer = new Customer(
            id: '1',
            name: 'Customer 1'
        );

        $customer->activate();

        $this->assertTrue($customer->isActive());
    }

    public function test_should_activate_customer(): void
    {
        $customer = new Customer(
            id: '1',
            name: 'Customer 1'
        );
        $address = new Address(
            street: 'Street 1',
            number: 123,
            zip: '13330-250',
            city: 'São Paulo'
        );

        $customer->setAddress($address);

        $customer->activate();

        $this->assertTrue($customer->isActive());
    }

    public function test_should_deactivate_customer(): void
    {
        $customer = new Customer(
            id: '1',
            name: 'Customer 1'
        );

        $customer->deactivate();

        $this->assertFalse($customer->isActive());
    }

    public function test_should_add_reward_points()
    {
        $customer = new Customer('1', 'Customer 1');

        $customer->addRewardPoints(100);

        $this->assertEquals(100, $customer->getRewardPoints());
    }

    public function test_should_throw_exception_when_adding_zero_reward_points()
    {
        $this->expectException(Exception::class);

        $customer = new Customer('1', 'Customer 1');

        $customer->addRewardPoints(0);
    }

    public function test_should_throw_exception_when_adding_negative_reward_points()
    {
        $this->expectException(Exception::class);

        $customer = new Customer('1', 'Customer 1');

        $customer->addRewardPoints(-100);
    }
}
