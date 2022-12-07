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
    ) {
        $this->sku = $sku;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
    }

    public function getSku() {
        return $this->sku;
    }

    public function getName() {
        return $this->name;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getPrice() {
        return $this->price;
    }
}