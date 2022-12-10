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

    /**
     * @dataProvider discountsProvider
     */
    public function testGetDiscountedPrice($categoryDiscount, $productDiscount, $expectedDiscount): void
    {
        $product = new Product('00001', 'nice boots', 'boots', 100, $categoryDiscount, $productDiscount);
        $this->assertEquals(
            $product->getDiscountedPrice(),
            $product->getPrice() - $expectedDiscount
        );
    }

        /**
     * @dataProvider discountsProvider
     */
    public function testGetAppliedDiscount($categoryDiscount, $productDiscount, $expectedDiscount): void
    {
        $product = new Product('00001', 'nice boots', 'boots', 100, $categoryDiscount, $productDiscount);
        $this->assertEquals(
            $expectedDiscount,
            $product->getAppliedDiscount()
        );
    }

    public function testGetCurrency()
    {
        $product = new Product('00001', 'nice boots', 'boots', 89000);   
        $this->assertEquals('EUR', $product->getCurrency());
    }

    public function discountsProvider(): array {
        return [
            "no discount applied" => [null,null,0,],
            "category discount only" => [10,null,10],
            "product discount only" => [null,10,10],
            "max discount applied being category" => [50,30,50],
            "mx discount pplied being product" => [25,35,35]
        ];
    }
}
