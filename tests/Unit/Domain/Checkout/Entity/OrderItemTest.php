<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Checkout\Entity;

use App\Domain\Checkout\Entity\OrderItem;
use App\Domain\Product\Entity\Product;
use PHPUnit\Framework\TestCase;

class OrderItemTest extends TestCase
{
    public function test_should_throw_error_if_name_id_is_empty(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Name is required');

        $product = new Product(
            id: 'p1',
            name: 'string',
            price: 10
        );

        new OrderItem(
            id: '1',
            product: $product,
            name: '',
            quantity: 1,
            price: 100
        );
    }

    public function test_should_throw_error_if_quantity_is_less_than_zero_when_is_negative(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Quantity must be greater than zero');

        $product = new Product(
            id: 'p1',
            name: 'string',
            price: 10
        );

        new OrderItem(
            id: '1',
            product: $product,
            name: 'Product 1',
            quantity: -1,
            price: 100
        );
    }

    public function test_should_throw_error_if_quantity_is_less_than_zero_when_is_zero(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Quantity must be greater than zero');

        $product = new Product(
            id: 'p1',
            name: 'string',
            price: 10
        );

        new OrderItem(
            id: '1',
            product: $product,
            name: 'Product 1',
            quantity: 0,
            price: 100
        );
    }

    public function test_should_throw_error_if_price_is_less_than_zero_when_is_negative(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Price must be greater than zero');

        $product = new Product(
            id: 'p1',
            name: 'string',
            price: 10
        );

        new OrderItem(
            id: '1',
            product: $product,
            name: 'Product 1',
            quantity: 1,
            price: -1
        );
    }

    public function test_should_throw_error_if_price_is_less_than_zero_when_is_zero(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Price must be greater than zero');

        $product = new Product(
            id: 'p1',
            name: 'string',
            price: 10
        );

        new OrderItem(
            id: '1',
            product: $product,
            name: 'Product 1',
            quantity: 1,
            price: 0
        );
    }

    public function test_should_create_new_order_item_successfully(): void
    {
        $product = new Product(
            id: 'p1',
            name: 'string',
            price: 10
        );

        $orderItem = new OrderItem(
            id: '1',
            product: $product,
            name: 'Product 1',
            quantity: 1,
            price: 100
        );

        $this->assertIsObject($orderItem);
    }

    public function test_should_get_quantity_successfully(): void
    {
        $product = new Product(
            id: 'p1',
            name: 'string',
            price: 10
        );

        $orderItem = new OrderItem(
            id: '1',
            product: $product,
            name: 'Product 1',
            quantity: 1,
            price: 100
        );

        $quantity = $orderItem->getQuantity();

        $this->assertEquals(1, $quantity);
    }

    public function test_should_get_price_successfully(): void
    {
        $product = new Product(
            id: 'p1',
            name: 'string',
            price: 10
        );

        $orderItem = new OrderItem(
            id: '1',
            product: $product,
            name: 'Product 1',
            quantity: 1,
            price: 100
        );

        $price = $orderItem->getPrice();

        $this->assertEquals(100, $price);
    }

    public function test_should_get_total_price_successfully(): void
    {
        $product = new Product(
            id: 'p1',
            name: 'string',
            price: 10
        );

        $orderItem = new OrderItem(
            id: '1',
            product: $product,
            name: 'Product 1',
            quantity: 5,
            price: 200
        );

        $totalPrice = $orderItem->getTotalPrice();

        $this->assertEquals(1000, $totalPrice);
    }
}
