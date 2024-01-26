<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\CustomerRepositoryInterface;
use App\Infrastructure\Database\Doctrine\Model\Customer;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    protected string $model = Customer::class;
}
