<?php


namespace App\Http\Requests;


use App\Http\Requests\Abstractions\AbstractRequest;
use App\Http\Requests\Dto\OrderCreateDto;
use App\Repositories\ProductsRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OrderCreateRequest extends AbstractRequest
{
    /**
     * @var OrderCreateDto
     */
    protected object $data;

    protected function postValidate(): void
    {
        /** @var ProductsRepository $productsRepository */
        $productsRepository = $this->container->get('products');
        $productIds = $this->data->products;
        foreach ($productIds as $product) {
            if (!is_int($product)) {
                $this->generateHttpError('product id must be a type of int, got: ' . gettype($product));
            }
            if ($productsRepository->find($product) === null) {
                $this->generateHttpError('product with id: ' . $product . ' is not exists');
            }
        }
    }

    protected function setDataFromRequest(): void
    {
        $this->data = new OrderCreateDto();
        $this->data->products = json_decode($this->request->getContent(), true)['products'] ?? [];

    }

    public function getData()
    {
        return $this->data->products;
    }
}
