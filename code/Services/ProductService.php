<?php

namespace Miquel\DiscountApi\Services;

use Doctrine\DBAL\Connection;
use Miquel\DiscountApi\Models\Product;

class ProductService
{
    /**
     * max number of products that can be retrieved at once
     */
    const MAX_RESULTS = 5;

    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getAllProducts($offset = 0, $category = null, $priceLessThan = null): array
    {
        $products = [];

        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('P.*', 'PD.product_discount', 'CD.category_discount')
            ->from('Products', 'P')
            ->leftJoin('P', '(select product_sku, discount_perc as product_discount from ProductDiscounts)', 'PD', 'PD.product_sku = P.sku')
            ->leftJoin('P', '(select category, discount_perc as category_discount from CategoryDiscounts)', 'CD', 'CD.category = P.category')
            ->setMaxResults(self::MAX_RESULTS)
            ->setFirstResult($offset);

        if (isset($category)) {
            $queryBuilder->andWhere('P.category = :category');
            $queryBuilder->setParameter('category', $category);
        }

        if (isset($priceLessThan)) {
            $queryBuilder->andWhere('P.price < :priceLessThan');
            $queryBuilder->setParameter('priceLessThan', $priceLessThan);
        }

        $result = $queryBuilder->fetchAllAssociative();
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
