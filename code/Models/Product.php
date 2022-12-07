<?php

namespace Miquel\DiscountApi\Models;

class Product
{
    /**
     * the product unique identifier
     */
    protected string $sku;

    /**
     * the product name
     */
    protected string $name;

    /**
     * the product category
     */
    protected string $category;
    
    /**
     * the product price
     */
    protected string $price;

    public function __construct(
        string $sku,
        string $name,
        string $category,
        int $price
    ) {}
}