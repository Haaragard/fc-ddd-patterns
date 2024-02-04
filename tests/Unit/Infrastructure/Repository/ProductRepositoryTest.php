<?php declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Repository;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;
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

        $this->assertNotNull($product->getId());
    }

    public function test_should_update_a_product(): void
    {
        $product = new Product(
            id: null,
            name: 'Product 1',
            price: 100
        );

        $this->repository->create($product);

        $product->changeName('Product 1 New Name');
        $product->changePrice(200);

        $this->repository->update($product);

        $updatedProduct = $this->repository->find($product->getId());

        $this->assertEquals($updatedProduct->toArray(), $product->toArray());
    }

    public function test_should_find_a_product(): void
    {
        $product = new Product(
            id: null,
            name: 'Product 1',
            price: 100
        );

        $this->repository->create($product);

        $productFound = $this->repository->find($product->getId());

        $this->assertEquals($productFound->toArray(), $product->toArray());
    }

    public function test_should_find_all_products(): void
    {
        $product = new Product(
            id: null,
            name: 'Product 1',
            price: 100
        );

        $product2 = new Product(
            id: null,
            name: 'Product 2',
            price: 200
        );

        $this->repository->create($product);
        $this->repository->create($product2);

        $allProducts = $this->repository->findAll();

        $this->assertEquals(
            array_map(fn (Product $product) => $product->toArray(), $allProducts),
            [$product->toArray(), $product2->toArray()]
        );
    }
}
