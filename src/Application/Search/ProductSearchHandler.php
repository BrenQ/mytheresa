<?php

namespace App\Application\Search;

use App\Application\ProductResponse;
use App\Domain\Entity\Product;
use App\Domain\Entity\ProductCategory;
use App\Domain\Entity\ProductCriteria;
use App\Infrastructure\Repository\ProductRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;

class ProductSearchHandler
{
    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function handle(ProductSearchCommand $productSearchCommand): string
    {
        // Search by multiple criteria
        $result = $this->repository->search(
           [
               new ProductCriteria($productSearchCommand->category(), ProductCriteria::EQUAL),
               new ProductCriteria($productSearchCommand->price(), ProductCriteria::LESS_THAN),
           ]
        );

        $response = new ProductResponse($result);
        return $response->parseJson();
    }
}