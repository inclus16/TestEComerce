<?php


namespace App\Services\Orders;


use App\Entities\Order;
use App\Entities\OrderStatus;
use App\Http\Requests\Dto\OrderPaymentDto;
use App\Repositories\OrdersRepository;
use App\Repositories\OrderStatusesRepository;
use App\Repositories\ProductsRepository;
use Symfony\Component\HttpClient\HttpClient;

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

    public function pay(OrderPaymentDto $dto): bool
    {
        if ($_ENV['APP_DEBUG'] == true) {
            $isOperationSuccess = true;
        } else {
            $client = HttpClient::create();
            $response = $client->request('POST', $_ENV['PAYMENT_AGGREGATOR_URL'], [
                'body' => [
                    'order_id' => $dto->orderId,
                    'cost' => $dto->cost
                ]
            ]);
            $isOperationSuccess = $response->getStatusCode() === 200;
        }
        if ($isOperationSuccess) {
            $this->orders->update($this->orders->find($dto->orderId)->setStatus($this->orderStatuses->find(OrderStatus::PAYED)));
        }
        return $isOperationSuccess;
    }
}
