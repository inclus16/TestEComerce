<?php


namespace App\Http\Requests\Abstractions;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractRequest
{
    protected object $data;

    protected Request $request;

    protected ContainerBuilder $container;

    protected ValidatorInterface $validator;

    public function __construct(Request $request, ContainerBuilder $containerBuilder)
    {
        $this->validator = $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
        $this->request = $request;
        $this->container = $containerBuilder;
    }

    protected function validate(): void
    {
        $violations = $this->validator->validate($this->data);
        if ($violations->count() > 0) {
            throw new BadRequestHttpException($violations[0]->getMessage());
        }
        $this->postValidate();
    }

    protected function generateHttpError(string $message)
    {
        throw new BadRequestHttpException($message);
    }

    protected abstract function postValidate(): void;

    protected abstract function setDataFromRequest(): void;

    public abstract function getData();

    public function init(): void
    {
        $this->setDataFromRequest();
        $this->validate();
    }
}
