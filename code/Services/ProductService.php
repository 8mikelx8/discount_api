<?php

namespace Miquel\DiscountApi\Services;

use Doctrine\DBAL\Connection;
use Miquel\DiscountApi\Models\Product;

class ProductService
{
    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getAllProducts(): array
    {
        $products = [];
        $result = $this->connection->fetchAllAssociative(
            'select P.*, PD.product_discount, CD.category_discount
            from Products as P
            left join (select product_sku, discount_perc as product_discount from ProductDiscounts) as PD on PD.product_sku = P.sku
            left join (select category, discount_perc as category_discount from CategoryDiscounts) as CD on CD.category = P.category
            '
        );
        foreach ($result as $productData) {
            $products[$productData['sku']] = new Product(
                $productData['sku'],
                $productData['name'],
                $productData['category'],
                $productData['price'],
                $productData['category_discount'],
                $productData['product_discount']
            );
        }
        return $products;
    }
}