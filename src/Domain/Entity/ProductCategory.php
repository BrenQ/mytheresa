<?php

namespace App\Domain\Entity;

use App\Domain\Entity\ProductValueInterface;

class ProductCategory implements ProductValueInterface
{
    const CATEGORY = "category";

    private string $category;

    public function __construct(string $category)
    {
        $this->category = $category;
    }

    public function value():string
    {
        return $this->category;
    }

    public function name(): string
    {
       return self::CATEGORY;
    }
}