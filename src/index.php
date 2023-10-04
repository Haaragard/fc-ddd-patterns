<?php declare(strict_types=1);

include_once __DIR__ . '/../vendor/autoload.php';

use App\Entity\Customer;
use App\Entity\Address;
use App\Entity\OrderItem;
use App\Entity\Order;

{
    $customer = new Customer('123', 'Diogo Antunes');
    $address = new Address('Rua dois', 2, '12345-678', 'Palhoça');

    $customer->setAddress($address);
    $customer->activate();

    $item1 = new OrderItem('1', 'Item 1', 10);
    $item2 = new OrderItem('2', 'Item 2', 15);

    $ordem = new Order('1', '123', [$item1, $item2]);

    die(var_dump($customer));
}