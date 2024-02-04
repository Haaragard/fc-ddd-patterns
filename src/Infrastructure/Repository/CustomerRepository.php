<?php

namespace App\Infrastructure\Repository;

use App\Domain\Customer\Repository\CustomerRepositoryInterface;
use App\Infrastructure\Database\Doctrine\Model\Customer;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    protected string $model = Customer::class;
}
