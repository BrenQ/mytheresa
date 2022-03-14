<?php

namespace App\Infrastructure\Controller;


use App\Application\Search\ProductSearchCommand;
use App\Application\Search\ProductSearchHandler;
use App\Domain\Entity\ProductCategory;
use App\Domain\Entity\ProductPrice;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{

    /**
     * @param Request $request
     * @return Response
     * @Route("/products", name="products", methods={"GET","HEAD"})
     */
    public function getProducts(Request $request, ProductSearchHandler $handler) :Response {

        $data = $handler->handle(new ProductSearchCommand(
            new ProductCategory($request->query->get("category")?: "") ,
            new ProductPrice( $request->query->get("priceLessThan")?: 0)
        ));

        return new JsonResponse($data,Response::HTTP_OK, [], true);
    }
}
