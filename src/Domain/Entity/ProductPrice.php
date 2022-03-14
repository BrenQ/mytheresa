<?php

namespace App\Domain\Entity;

class ProductPrice implements ProductValueInterface
{
    private int $price;

    const PRICE = "price";

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    public function value():string
    {
        return $this->price;
    }

    public function name():string
    {
        return self::PRICE;
    }
}