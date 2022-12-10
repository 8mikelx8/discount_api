<?php

namespace App\Test\TestCase\Services;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Miquel\DiscountApi\Models\Product;
use Miquel\DiscountApi\Services\ProductService;
use PHPUnit\Framework\TestCase;

/**
 * Test.
 *
 * @coversDefaultClass \App\Action\Customer\CustomerDeleterAction
 */
class ProductServiceTest extends TestCase
{
    public function getProductService(): ProductService
    {
        return new ProductService($this->getMockedConnection());
    }

    public function getMockedConnection(): Connection
    {
        $stubQueryBuilder = $this->createStub(QueryBuilder::class);
        $stubQueryBuilder->method('fetchAllAssociative')
            ->willReturn($this->fetchAllProducts());
        $stubQueryBuilder->method('select')
            ->willReturn($stubQueryBuilder);
        $stubQueryBuilder->method('from')
            ->willReturn($stubQueryBuilder);
        $stubQueryBuilder->method('leftJoin')
            ->willReturn($stubQueryBuilder);
        $stubQueryBuilder->method('setMaxResults')
            ->willReturn($stubQueryBuilder);
        $stubQueryBuilder->method('setFirstResult')
            ->willReturn($stubQueryBuilder);
        $stubQueryBuilder->method('andWhere')
            ->willReturn($stubQueryBuilder);
        $stubQueryBuilder->method('setParameter')
            ->willReturn($stubQueryBuilder);

        $stubConnection = $this->createStub(Connection::class);
        $stubConnection->method('createQueryBuilder')
            ->willReturn($stubQueryBuilder);

        return $stubConnection;
    }

    public function testGetAllProducts(): void
    {
        $productService = $this->getProductService();
        $allProducts = $productService->getAllProducts();
        foreach ($allProducts as $sku => $product) {
            $this->assertEquals($sku, $product['sku']);
        }
    }

    public function fetchAllProducts(): array
    {
        return array(
            0 => array('sku' => '000001', 'name' => 'BV Lean leather ankle boots', 'category' => 'boots', 'price' => 89000, 'product_discount' => NULL, 'category_discount' => 30,),
            1 => array('sku' => '000002', 'name' => 'BV Lean leather ankle boots', 'category' => 'boots', 'price' => 99000, 'product_discount' => NULL, 'category_discount' => 30,),
            2 => array('sku' => '000003', 'name' => 'Ashlington leather ankle boots', 'category' => 'boots', 'price' => 71000, 'product_discount' => 15, 'category_discount' => 30,),
            3 => array('sku' => '000004', 'name' => 'Naima embellished suede sandals', 'category' => 'sandals', 'price' => 79500, 'product_discount' => NULL, 'category_discount' => NULL,),
            4 => array('sku' => '000005', 'name' => 'Nathane leather sneakers', 'category' => 'sneakers', 'price' => 59000, 'product_discount' => NULL, 'category_discount' => NULL,),
        );
    }
}
