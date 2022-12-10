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
    protected ?int $categoryDiscount;

    /**
     * Discount applied to the individual product in %
     */
    protected ?int $productDiscount;

    /**
     * Product original currency
     */
    protected  string $currency = 'EUR';

    public function __construct(
        string $sku,
        string $name,
        string $category,
        int $price,
        ?int $categoryDiscount = 0,
        ?int $productDiscount = 0
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
        return $this->price * ((100 - $this->getAppliedDiscount()) / 100);
    }

    public function getAppliedDiscount(): int
    {
        return max($this->categoryDiscount, $this->productDiscount) ?: 0;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function toArray(): array
    {
        return [
            'sku' => $this->getSku(),
            'name'  => $this->getName(),
            'category' => $this->getCategory(),
            'price' => [
                'original' => $this->getPrice(),
                'final' => $this->getDiscountedPrice(),
                'discount_percentage' => $this->getAppliedDiscount(),
                'currency' => $this->getCurrency()
            ]
        ];
    }
}
