<?php


namespace App\Controllers;


use App\Http\Responses\JsonApiResponse;
use App\Repositories\ProductsRepository;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController
{
    private ProductsRepository $products;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->products = $containerBuilder->get('products');
    }

    public function list(): JsonResponse
    {
        return JsonApiResponse::success(['products' => $this->products->findAll()]);
    }

}
