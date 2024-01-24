<?php declare(strict_types=1);

const BASE_PATH = __DIR__;

require_once 'config/bootstrap.php';

{
    $product = new \App\Infrastructure\Database\Doctrine\Model\Product();
    $product->setName('Product 1');
    $product->setPrice(100);

    try {
        $entityManager->persist($product);
        $entityManager->flush();

    } catch (\Throwable $th) {
        var_dump($th->getMessage());
    }

//    echo "Created Product with ID {$product->getId()} \n";

//    $customer = new Customer('123', 'Diogo Antunes');
//    $address = new Address('Rua dois', 2, '12345-678', 'Palhoça');
//
//    $customer->setAddress($address);
//    $customer->activate();
//
//    $item1 = new OrderItem('1', 'I1', 'Item 1', 1, 10);
//    $item2 = new OrderItem('2', 'I2','Item 2', 2, 15);
//
//    $ordem = new Order('1', '123', [$item1, $item2]);
//
//    die(var_dump($customer));
}
