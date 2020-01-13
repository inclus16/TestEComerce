<?php


namespace App\Controllers;


use App\Http\Requests\OrderCreateRequest;
use App\Repositories\OrdersRepository;
use App\Repositories\ProductsRepository;
use App\Services\Orders\OrdersManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController
{
    private OrdersManager $orders;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->orders = $containerBuilder->get('orders_manager');
    }

    public function create(OrderCreateRequest $orderCreateRequest)
    {
        return new JsonResponse(['id' => $this->orders->create($orderCreateRequest->getData())]);
    }
}
