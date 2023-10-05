<?php declare(strict_types=1);

namespace Tests\Unit\Entity;
use App\Entity\OrderItem;
use PHPUnit\Framework\TestCase;

class OrderItemTest extends TestCase
{
    public function test_should_throw_error_if_id_is_empty(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Id is required');

        // Arrange

        // Act
        new OrderItem(
            id: '',
            productId: 'p1',
            name: 'Product 1',
            quantity: 1,
            price: 100
        );

        // Assert
    }

    public function test_should_throw_error_if_product_id_is_empty(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Product Id is required');

        // Arrange

        // Act
        new OrderItem(
            id: '1',
            productId: '',
            name: 'Product 1',
            quantity: 1,
            price: 100
        );

        // Assert
    }

    public function test_should_throw_error_if_name_id_is_empty(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Name is required');

        // Arrange

        // Act
        new OrderItem(
            id: '1',
            productId: 'p1',
            name: '',
            quantity: 1,
            price: 100
        );

        // Assert
    }

    public function test_should_throw_error_if_quantity_is_less_than_zero_when_is_negative(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Quantity must be greater than zero');

        // Arrange

        // Act
        new OrderItem(
            id: '1',
            productId: 'p1',
            name: 'Product 1',
            quantity: -1,
            price: 100
        );

        // Assert
    }

    public function test_should_throw_error_if_quantity_is_less_than_zero_when_is_zero(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Quantity must be greater than zero');

        // Arrange

        // Act
        new OrderItem(
            id: '1',
            productId: 'p1',
            name: 'Product 1',
            quantity: 0,
            price: 100
        );

        // Assert
    }

    public function test_should_throw_error_if_price_is_less_than_zero_when_is_negative(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Price must be greater than zero');

        // Arrange

        // Act
        new OrderItem(
            id: '1',
            productId: 'p1',
            name: 'Product 1',
            quantity: 1,
            price: -1
        );

        // Assert
    }

    public function test_should_throw_error_if_price_is_less_than_zero_when_is_zero(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Price must be greater than zero');

        // Arrange

        // Act
        new OrderItem(
            id: '1',
            productId: 'p1',
            name: 'Product 1',
            quantity: 1,
            price: 0
        );

        // Assert
    }

    public function test_should_create_new_order_item_successfully(): void
    {
        // Arrange
        $orderItem = new OrderItem(
            id: '1',
            productId: 'p1',
            name: 'Product 1',
            quantity: 1,
            price: 100
        );

        // Act

        // Assert
        $this->assertIsObject($orderItem);
    }
    
    public function test_should_get_quantity_successfully(): void
    {
        // Arrange
        $orderItem = new OrderItem(
            id: '1',
            productId: 'p1',
            name: 'Product 1',
            quantity: 1,
            price: 100
        );

        // Act
        $quantity = $orderItem->getQuantity();

        // Assert
        $this->assertEquals(1, $quantity);
    }

    public function test_should_get_price_successfully(): void
    {
        // Arrange
        $orderItem = new OrderItem(
            id: '1',
            productId: 'p1',
            name: 'Product 1',
            quantity: 1,
            price: 100
        );

        // Act
        $price = $orderItem->getPrice();

        // Assert
        $this->assertEquals(100, $price);
    }

    public function test_should_get_total_price_successfully(): void
    {
        // Arrange
        $orderItem = new OrderItem(
            id: '1',
            productId: 'p1',
            name: 'Product 1',
            quantity: 5,
            price: 200
        );

        // Act
        $totalPrice = $orderItem->getTotalPrice();

        // Assert
        $this->assertEquals(1000, $totalPrice);
    }
}