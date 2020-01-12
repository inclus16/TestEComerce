<?php


namespace App\Controllers;


use App\Repositories\OrdersRepository;
use App\Repositories\ProductsRepository;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController
{
    private OrdersRepository $orders;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->orders=$containerBuilder->get('orders');
    }

    public function index(Request $request)
    {
        dd($this->orders->findAll());
        return new Response('awewae', 200);
    }
}
