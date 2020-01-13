<?php


namespace App\Controllers;


use App\Http\Requests\OrderCreateRequest;
use App\Http\Responses\JsonApiResponse;
use App\Services\Orders\OrdersManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OrderController
{
    private OrdersManager $orders;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->orders = $containerBuilder->get('orders_manager');
    }

    public function create(OrderCreateRequest $orderCreateRequest): JsonResponse
    {
        return JsonApiResponse::success(['id' => $this->orders->create($orderCreateRequest->getData())]);
    }

    public function list(Request $request): JsonResponse
    {
        return JsonApiResponse::success(['orders' => $this->orders->list()]);
    }
}
