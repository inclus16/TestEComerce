<?php


namespace App\Http\Requests;


use App\Entities\Order;
use App\Entities\OrderStatus;
use App\Entities\Product;
use App\Http\Requests\Abstractions\AbstractRequest;
use App\Http\Requests\Dto\OrderPaymentDto;
use App\Repositories\OrdersRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OrderPaymentRequest extends AbstractRequest
{
    /**
     * @var OrderPaymentDto
     */
    protected object $data;

    protected function postValidate(): void
    {
        /** @var OrdersRepository $ordersRepository */
        $ordersRepository = $this->container->get('orders');
        /** @var Order $order */
        $order = $ordersRepository->find($this->data->orderId);
        if ($order === null) {
            $this->generateHttpError('order with id: ' . $this->data->orderId . ' does not exists');
        }
        $costFromDatabase = 0;
        $products = $order->getProducts();
        foreach ($products as $product) {
            $costFromDatabase += $product->getCost();
        }
        if ($costFromDatabase !== $this->data->cost) {
            $this->generateHttpError('cost from database and from request must be equal');
        }
        if ($order->getStatus()->getId() !== OrderStatus::CREATED) {
            $this->generateHttpError('payment can be done only with new order');
        }
    }

    protected function setDataFromRequest(): void
    {
        $requestData = json_decode($this->request->getContent(), true);
        $this->data = new OrderPaymentDto();
        $this->data->orderId = $requestData['order_id'] ?? null;
        $this->data->cost = $requestData['cost'] ?? null;
    }

    public function getData()
    {
        return $this->data;
    }
}
