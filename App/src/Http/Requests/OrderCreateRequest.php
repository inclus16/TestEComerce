<?php


namespace App\Http\Requests;


use App\Http\Requests\Abstractions\AbstractRequest;
use App\Repositories\ProductsRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;

class OrderCreateRequest extends AbstractRequest
{
    /**
     * products ids
     * int[]
     * @Assert\NotBlank(message="array 'products' must be at upper level of json body and not be empty")
     * @Assert\Type(type="array",message="array 'products' must be an array")
     */
    public ?array $products;

    protected function validate(): void
    {
        $violations = $this->validator->validate($this);
        if ($violations->count() > 0) {
            throw new BadRequestHttpException($violations[0]->getMessage());
        }
        $this->validateIds();
    }

    private function validateIds(): void
    {
        /** @var ProductsRepository $productsRepository */
        $productsRepository = $this->container->get('products');
        foreach ($this->products as $product) {
            if (!is_int($product)) {
                throw new BadRequestHttpException('product id must be a type of int, got: ' . gettype($product));
            }
            if ($productsRepository->find($product) === null) {
                throw new BadRequestHttpException('product with id: '.$product.' is not exists');
            }
        }
    }

    protected function setDataFromRequest(): void
    {
        $this->products = json_decode($this->request->getContent(), true)['products'] ?? [];

    }

    public function getData()
    {
        return $this->products;
    }
}
