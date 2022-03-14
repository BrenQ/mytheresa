<?php

namespace App\Domain\Entity;

class ProductCriteria
{
    const LESS_THAN = "less_than";
    const EQUAL = "equal";

    private ProductValueInterface $value;
    private string $criteria;

    public function __construct(ProductValueInterface $value, string $criteria )
    {
        $this->value = $value;
        $this->criteria = $criteria;
    }

    public function get(): ProductValueInterface
    {
        return $this->value;
    }

    public function getCriteria(): string
    {
        return $this->criteria;
    }

}