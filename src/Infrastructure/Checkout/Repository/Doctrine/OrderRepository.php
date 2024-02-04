<?php

namespace App\Infrastructure\Checkout\Repository\Doctrine;

use App\Domain\Checkout\Repository\OrderRepositoryInterface;
use App\Infrastructure\Checkout\Model\Doctrine\Order;
use App\Infrastructure\Shared\Repository\Repository;

class OrderRepository extends Repository implements OrderRepositoryInterface
{
    protected string $model = Order::class;
}
