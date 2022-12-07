<?php

namespace App\Test\TestCase\Models;

use PHPUnit\Framework\TestCase;
use Miquel\DiscountApi\Models\Product;

/**
 * Test.
 *
 * @coversDefaultClass \App\Action\Customer\CustomerDeleterAction
 */
class ProductTest extends TestCase
{
    public function testConstruct(): void
    {
        $product = new Product('00001', 'nice boots', 'boots', 89000);
        $this->assertInstanceOf(Product::Class, $product);
    }

    public function testGetSku(): void
    {
        $sku = '0123031';
        $product = new Product($sku, 'nice boots', 'boots', 1234);
        $this->assertEquals($sku, $product->getSku());
    }

    public function testGetName(): void
    {
        $name = 'product name for test';
        $product = new Product('00001',  $name, 'boots', 12345);
        $this->assertEquals( $name, $product->getName());
    }

    public function testGetCategory(): void
    {
        $category = 'category for test';
        $product = new Product('00001', 'nice boots', $category, 12345);
        $this->assertEquals($category, $product->getCategory());
    }

    public function testGetPrice(): void
    {
        $price = random_int(10,999999);
        $product = new Product('00001', 'nice boots', 'boots', $price);
        $this->assertEquals($price, $product->getPrice());
    }
}
