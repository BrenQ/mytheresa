<?php

namespace App\Domain\Entity;

use App\Domain\Entity\ProductCategory;

final class Product
{
    protected string $id;

    protected string $name;

    protected ProductCategory $category;

    protected ProductPrice $price;

    public function __construct(string $id, string $name, ProductCategory $category, ProductPrice $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ProductCategory
     */
    public function getCategory(): ProductCategory
    {
        return $this->category;
    }

    /**
     * @param ProductCategory $category
     */
    public function setCategory(ProductCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return ProductPrice
     */
    public function getPrice(): ProductPrice
    {
        return $this->price;
    }

    /**
     * @param ProductPrice $price
     */
    public function setPrice(ProductPrice $price): self
    {
        $this->price = $price;

        return $this;
    }
}