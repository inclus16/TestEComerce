<?php


namespace App\Controllers;


use App\Repositories\ProductsRepository;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController
{
    private ProductsRepository $products;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->products=$containerBuilder->get('products');
    }

    public function index(Request $request)
    {
        return new Response('awewae', 200);
    }
}
