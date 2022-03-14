<?php

namespace App\Application;

use App\Infrastructure\Repository\ProductRepositoryInterface;

class ProductService
{
    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function handle(): string
    {
        $response = new ProductResponse($this->repository->getAll());
        return $response->parseJson();
    }
}