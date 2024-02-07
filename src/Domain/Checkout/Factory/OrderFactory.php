<?php

namespace App\Domain\Checkout\Factory;

use App\Domain\Checkout\Entity\Order;
use App\Domain\Checkout\Entity\OrderItem;
use App\Domain\Customer\Entity\Customer;
use App\Domain\Customer\Factory\CustomerFactory;
use App\Domain\Shared\Entity\BaseEntity;
use App\Domain\Shared\Factory\BaseFactory;
use Ramsey\Uuid\Uuid;

class OrderFactory extends BaseFactory
{
    public static function create(array $data = []): BaseEntity|Order
    {
        $orderItems = $data['order_items'] ?? [OrderItemFactory::create()];
        foreach ($data['order_items'] as $orderItem) {
            if (!($orderItem instanceof OrderItem)) {
                $orderItems[] = OrderItemFactory::create($orderItem);
            }
        }

        $customer = $data['customer'];
        if (!($customer instanceof Customer)) {
            $customer = CustomerFactory::create($customer ?? []);
        }

        return new Order(
            id: $data['id'] ?? (string) Uuid::uuid4(),
            customer: $customer,
            items: $orderItems
        );
    }
}
