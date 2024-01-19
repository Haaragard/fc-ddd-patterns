<?php declare(strict_types=1);

namespace Tests\Unit\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function test_should_throw_error_when_id_is_empty(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Id is required');

        // Arrange

        // Act
        new Product(
            id: '',
            name: 'Product 1',
            price: 10
        );

        // Assert
    }

    public function test_should_throw_error_when_name_is_empty(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Name is required');

        // Arrange

        // Act
        new Product(
            id: '1',
            name: '',
            price: 10
        );

        // Assert
    }

    public function test_should_throw_error_when_price_is_less_than_zero_when_given_negative(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Price must be greater than zero');

        // Arrange

        // Act
        new Product(
            id: '1',
            name: 'Product 1',
            price: -1
        );

        // Assert
    }

    public function test_should_throw_error_when_price_is_less_than_zero_when_given_zero(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Price must be greater than zero');

        // Arrange

        // Act
        new Product(
            id: '1',
            name: 'Product 1',
            price: 0
        );

        // Assert
    }

    public function test_should_change_name(): void
    {
        // Arrange
        $product = new Product(
            id: '1',
            name: 'Product 1',
            price: 10
        );

        // Act
        $product->changeName('Product 1 Name Changed');

        // Assert
        $this->assertEquals('Product 1 Name Changed', $product->getName());
    }

    public function test_should_change_price(): void
    {
        // Arrange
        $product = new Product(
            id: '1',
            name: 'Product 1',
            price: 10
        );

        // Act
        $product->changePrice(30);

        // Assert
        $this->assertEquals(30, $product->getPrice());
    }
}
