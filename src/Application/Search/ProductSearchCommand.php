<?php

namespace App\Application\Search;

use App\Domain\Entity\ProductCategory;
use App\Domain\Entity\ProductPrice;

class ProductSearchCommand
{

    private ?ProductCategory $category;
    private ?ProductPrice $price;

    public function __construct(ProductCategory $category, ProductPrice $price)
    {
        $this->price= $price;
        $this->category =$category;
    }

    public function category()
    {
        return $this->category;
    }

    public function price()
    {
        return $this->price;
    }

}