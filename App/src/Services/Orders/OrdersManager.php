<?php


namespace App\Services\Orders;


use App\Entities\Order;
use App\Entities\OrderStatus;
use App\Repositories\OrdersRepository;
use App\Repositories\OrderStatusesRepository;
use App\Repositories\ProductsRepository;

class OrdersManager
{
    private OrdersRepository $orders;

    private OrderStatusesRepository $orderStatuses;

    private ProductsRepository $products;

    public function __construct(OrdersRepository $orders, OrderStatusesRepository $orderStatuses, ProductsRepository $products)
    {
        $this->orders = $orders;
        $this->products = $products;
        $this->orderStatuses = $orderStatuses;
    }

    /**
     * @param int[] $ids
     * @return int
     * Creates an order, and return id from database
     */
    public function create(array $ids): int
    {
        $order = new Order();
        $order->setStatus($this->orderStatuses->find(OrderStatus::CREATED))
            ->setProducts($this->products->findRange($ids)->toArray());
        $this->orders->add($order);
        return $order->getId();
    }
}
