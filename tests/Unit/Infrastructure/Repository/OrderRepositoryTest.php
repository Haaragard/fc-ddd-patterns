<?php declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Repository;

use App\Domain\Entity\Address;
use App\Domain\Entity\Customer;
use App\Domain\Entity\Order;
use App\Domain\Entity\OrderItem;
use App\Domain\Entity\Product;
use App\Domain\Repository\CustomerRepositoryInterface;
use App\Domain\Repository\OrderRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Infrastructure\Repository\CustomerRepository;
use App\Infrastructure\Repository\OrderRepository;
use App\Infrastructure\Repository\ProductRepository;
use Tests\DatabaseTestCase;

class OrderRepositoryTest extends DatabaseTestCase
{
    private OrderRepositoryInterface $repository;
    private CustomerRepositoryInterface $customerRepository;
    private ProductRepositoryInterface $productRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new OrderRepository($this->getEntityManager());
        $this->customerRepository = new CustomerRepository($this->getEntityManager());
        $this->productRepository = new ProductRepository($this->getEntityManager());
    }

    public function test_should_create_a_order(): void
    {
        $customer = new Customer(
            id: null,
            name: 'Customer 1'
        );
        $address = new Address(
            street: 'Street 1',
            number: 1,
            zip: '123123',
            city: 'Fake City'
        );
        $customer->setAddress($address);
        $this->customerRepository->create($customer);

        $product = new Product(
            id: null,
            name: 'Product 1',
            price: 100
        );
        $this->productRepository->create($product);

        $orderItem = new OrderItem(
            id: null,
            product: $product,
            name: $product->getName(),
            quantity: 1,
            price: $product->getPrice()
        );

        $order = new Order(
            id: null,
            customer: $customer,
            items: [$orderItem]
        );

        $this->repository->create($order);

        $this->assertNotNull($customer->getId());
        $this->assertNotNull($product->getId());
        $this->assertNotNull($order->getId());
    }

    public function test_should_update_a_order(): void
    {
        $customer = new Customer(
            id: null,
            name: 'Customer 1'
        );
        $address = new Address(
            street: 'Street 1',
            number: 1,
            zip: '123123',
            city: 'Fake City'
        );
        $customer->setAddress($address);
        $this->customerRepository->create($customer);

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

        $this->productRepository->create($product);
        $this->productRepository->create($product2);

        $orderItem = new OrderItem(
            id: null,
            product: $product,
            name: $product->getName(),
            quantity: 1,
            price: $product->getPrice()
        );

        $orderItem2 = new OrderItem(
            id: null,
            product: $product2,
            name: $product2->getName(),
            quantity: 2,
            price: $product2->getPrice()
        );

        $order = new Order(
            id: null,
            customer: $customer,
            items: [$orderItem]
        );

        $this->repository->create($order);

        $order->setItems([$orderItem, $orderItem2]);

        $this->repository->update($order);

        $updatedOrder = $this->repository->find($order->getId());

        $this->assertEquals($updatedOrder->toArray(), $order->toArray());
    }

    public function test_should_find_a_customer(): void
    {
        $customer = new Customer(
            id: null,
            name: 'Customer 1'
        );
        $address = new Address(
            street: 'Street 1',
            number: 1,
            zip: '123123',
            city: 'Fake City'
        );
        $customer->setAddress($address);
        $this->customerRepository->create($customer);

        $product = new Product(
            id: null,
            name: 'Product 1',
            price: 100
        );
        $this->productRepository->create($product);

        $orderItem = new OrderItem(
            id: null,
            product: $product,
            name: $product->getName(),
            quantity: 1,
            price: $product->getPrice()
        );

        $order = new Order(
            id: null,
            customer: $customer,
            items: [$orderItem]
        );

        $this->repository->create($order);

        $orderFound = $this->repository->find($order->getId());

        $this->assertEquals($orderFound->toArray(), $order->toArray());
    }

    public function test_should_find_all_customers(): void
    {
        $customer = new Customer(
            id: null,
            name: 'Customer 1'
        );
        $address = new Address(
            street: 'Street 1',
            number: 1,
            zip: '123123',
            city: 'Fake City'
        );
        $customer->setAddress($address);
        $this->customerRepository->create($customer);

        $product = new Product(
            id: null,
            name: 'Product 1',
            price: 100
        );
        $this->productRepository->create($product);

        $orderItem = new OrderItem(
            id: null,
            product: $product,
            name: $product->getName(),
            quantity: 1,
            price: $product->getPrice()
        );

        $orderItem2 = new OrderItem(
            id: null,
            product: $product,
            name: $product->getName(),
            quantity: 5,
            price: $product->getPrice()
        );

        $order = new Order(
            id: null,
            customer: $customer,
            items: [$orderItem]
        );

        $order2 = new Order(
            id: null,
            customer: $customer,
            items: [$orderItem2]
        );

        $this->repository->create($order);
        $this->repository->create($order2);

        $allOrders = $this->repository->findAll();

        $this->assertEquals(
            array_map(fn (Order $order) => $order->toArray(), $allOrders),
            [$order->toArray(), $order2->toArray()]
        );
    }
}
