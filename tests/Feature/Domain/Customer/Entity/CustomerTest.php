<?php

namespace Tests\Feature\Domain\Customer\Entity;

use App\Application\Event\EventDispatcherInterface;
use App\Domain\Customer\Factory\AddressFactory;
use App\Domain\Customer\Factory\CustomerFactory;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    private EventDispatcherInterface $eventDispatcher;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);

        set_event_dispatcher($this->eventDispatcher);
    }

    public function test_should_dispatch_customer_created_event()
    {
        $customer = CustomerFactory::create();

        $this->eventDispatcher->expects($this->once())
            ->method('notify');

        $customer->sendCreatedEvents();
    }

    public function test_should_dispatch_address_changed_event()
    {
        $customer = CustomerFactory::create();
        $address = AddressFactory::create();

        $this->eventDispatcher->expects($this->once())
            ->method('notify');

        $customer->changeAddress($address);
    }
}
