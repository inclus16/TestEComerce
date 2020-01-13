<?php


namespace App\Controllers;


use App\Http\Requests\OrderPaymentRequest;
use App\Http\Responses\JsonApiResponse;
use App\Services\Orders\OrdersManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderPaymentController
{
    private OrdersManager $orders;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->orders = $containerBuilder->get('orders_manager');
    }

    public function pay(OrderPaymentRequest $orderPaymentRequest): JsonResponse
    {
        return JsonApiResponse::success(['success' => $this->orders->pay($orderPaymentRequest->getData())]);
    }
}
