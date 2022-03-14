<?php

namespace App\Infrastructure\Repository\InMemory;

use App\Domain\Entity\ProductCategory;
use App\Domain\Entity\ProductCriteria;
use App\Domain\Entity\ProductPrice;
use App\Infrastructure\Repository\ProductRepositoryInterface;
use App\Domain\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;

class ProductRepository implements ProductRepositoryInterface
{
    private ArrayCollection $data;

    const LIMIT = 5;

    public function __construct(array $data = [] )
    {
        if ( empty($data) ) {
            $this->setUp();
            return;
        }
        
        $this->data = $data;
    }

    public function find(string $id): Product
    {
        if (!$this->exists($id)) {
            return new Product();
        }

        return $this->data[$id];
    }

    public function exists(string $id): bool
    {
        return $this->data->exists($id);
    }

    public function getAll(): ArrayCollection
    {
        return $this->data;
    }

    public function search(...$productCriteria): ArrayCollection
    {
        $result = new ArrayCollection();

        $criteria = $this->getAllCriteria($productCriteria);

        foreach ( $this->data as $value) {

            $categoryCriteria = $criteria[$value->getCategory()->name()];

            if (!empty($categoryCriteria->get()->value()) &&
                     $categoryCriteria->getCriteria() == ProductCriteria::EQUAL &&
                    !($categoryCriteria->get()->value() == $value->getCategory()->value())) {
                continue;
            }

            $priceCriteria = $criteria[$value->getPrice()->name()];

            if (!empty($priceCriteria->get()->value()) &&
                $categoryCriteria->getCriteria() == ProductCriteria::LESS_THAN &&
                !($value->getPrice()->value() < $priceCriteria->get()->value())) {
               continue;
            }

            $result[] = $value;

            if (count($result) > self::LIMIT){
                break;
            }
        }

        return $result;
    }

    private function getAllCriteria($productCriteria): array
    {
        $allCriteria = [];

        foreach ($productCriteria[0] as $criteria) {
            $allCriteria[$criteria->get()->name()] = $criteria;
        }

        return $allCriteria;
    }

    public function save(Product $product): void
    {
        $this->data[$product->getId()] = $product;
    }

    protected function setUp(): void
    {
        $this->data = new ArrayCollection([
          new Product("000001", "BV Lean leather ankle boots", new ProductCategory("boots"), new ProductPrice(89000)),
          new Product("000002", "BV Lean leather ankle boots", new ProductCategory("boots"), new ProductPrice(99000)),
          new Product("000003", "Ashlington leather ankle boots", new ProductCategory("boots"), new ProductPrice(71000)),
          new Product("000004", "Naima embellished suede sandals", new ProductCategory("sandals"), new ProductPrice(79500)),
          new Product("000005", "Nathane leather sneakers", new ProductCategory("sneakers"), new ProductPrice(59000)),
        ]);
    }
}