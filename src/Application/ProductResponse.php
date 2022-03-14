<?php

namespace App\Application;

use App\Domain\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer;

final class ProductResponse
{
    private ArrayCollection $products;

    public function __construct(ArrayCollection $products)
    {
        $this->products = $products;
    }

    public function parseJson(): string
    {
        $result = [];

        foreach ( $this->products as $value) {
            $result[] =  [
                'sku' => $value->getId(),
                'name' =>  $value->getName(),
                'category' =>  $value->getCategory()->value(),
                'price' =>  $value->getPrice()->value()
            ];
        }

        return json_encode($result);
    }
}