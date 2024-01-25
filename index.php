<?php declare(strict_types=1);

require_once 'config/bootstrap.php';

{
    $product = new \App\Infrastructure\Database\Doctrine\Model\Product();
    $product->setName('Product 1');
    $product->setPrice(100);

    $entityManager->persist($product);
    $entityManager->flush();

}
