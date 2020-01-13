<?php


namespace Sys;


use App\Http\Requests\Abstractions\AbstractRequest;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;

/**
 * Responsible for resolving the arguments passed to an action.
 *
 */
final class ArgumentResolver implements ArgumentResolverInterface
{

    private ContainerBuilder $container;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->container = $containerBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getArguments(Request $request, callable $controller): array
    {
        $arguments = [];
        $reflectionController = new \ReflectionClass($controller[0]);
        $parameters = $reflectionController->getMethod($controller[1])->getParameters();
        foreach ($parameters as $parameter) {
            $argumentClassName = $parameter->getClass()->name;
            $argumentObject = new $argumentClassName($request, $this->container);
            if ($argumentObject instanceof AbstractRequest) {
                $argumentObject->init();
            }
            $arguments[] = $argumentObject;
        }
        return $arguments;
    }

}
