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

    /**
     * Discount applied by the product category in %
     */
    protected int $categoryDiscount;

    /**
     * Discount applied to the individual product in %
     */
    protected int $productDiscount;

    public function __construct(
        string $sku,
        string $name,
        string $category,
        int $price,
        int $categoryDiscount = 0,
        int $productDiscount = 0
    ) {
        $this->sku = $sku;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
        $this->categoryDiscount = $categoryDiscount;
        $this->productDiscount = $productDiscount;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDiscountedPrice(): int
    {
        $discount = max($this->categoryDiscount, $this->productDiscount);
        return $this->price * ((100 - $discount) / 100);
    }
}
