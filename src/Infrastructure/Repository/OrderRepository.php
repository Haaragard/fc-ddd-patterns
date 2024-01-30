<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\OrderRepositoryInterface;
use App\Infrastructure\Database\Doctrine\Model\Order;

class OrderRepository extends Repository implements OrderRepositoryInterface
{
    protected string $model = Order::class;
}
