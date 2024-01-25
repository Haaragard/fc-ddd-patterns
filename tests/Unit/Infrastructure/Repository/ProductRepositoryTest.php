<?php declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Repository;

use App\Domain\Entity\Product;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Infrastructure\Repository\ProductRepository;
use Tests\DatabaseTestCase;

class ProductRepositoryTest extends DatabaseTestCase
{
    private ProductRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new ProductRepository($this->getEntityManager());
    }
    public function test_should_create_a_product(): void
    {
        $product = new Product(
            id: null,
            name: 'Product 1',
            price: 100
        );

        $this->repository->create($product);

        $createdProduct = $this->repository->find($product->getId());

        $this->assertEquals($createdProduct->toArray(), $product->toArray());
    }
}
