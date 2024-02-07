<?php

namespace App\Domain\Customer\Event\Handler;

use App\Application\Event\EventHandlerInterface;
use App\Application\Event\EventInterface;
use App\Domain\Customer\Entity\Customer;
use App\Domain\Customer\ValueObject\Address;

class SendAddressChangedConsoleLogEventHandler implements EventHandlerInterface
{
    public function handle(EventInterface $event): void
    {
        /**
         * @var null|Customer
         */
        $customer = $event->getEventData()['customer'];

        /**
         * @var null|Address
         */
        $address = $customer->getAddress();

        echo sprintf(
            'Endereço do cliente: %s, %s alterado para: %s, %s, %s, %s',
            $customer->getId(),
            $customer->getName(),
            $address->getStreet(),
            $address->getNumber(),
            $address->getZip(),
            $address->getCity()
        );
    }
}
