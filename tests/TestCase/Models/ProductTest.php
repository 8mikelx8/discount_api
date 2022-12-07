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
}
