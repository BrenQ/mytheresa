<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Product;
use App\Domain\Entity\ProductCategory;
use App\Domain\Entity\ProductCriteria;
use Doctrine\Common\Collections\ArrayCollection;
use App\Domain\Entity\ProductValueInterface;

interface ProductRepositoryInterface
{
    public function getAll(): ArrayCollection;
    public function search(ProductCriteria ...$productValue): ArrayCollection;
    public function exists(string $id): bool;
    public function save(Product $product): void;
}