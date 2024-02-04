<?php

namespace App\Infrastructure\Customer\Repository\Doctrine;

use App\Domain\Customer\Repository\CustomerRepositoryInterface;
use App\Infrastructure\Customer\Model\Doctrine\Customer;
use App\Infrastructure\Shared\Repository\Repository;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    protected string $model = Customer::class;
}
