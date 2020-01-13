<?php


namespace Sys;


use App\Http\Responses\JsonApiResponse;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionHandler
{

    public static function onError(ExceptionEvent $event)
    {
        switch (get_class($event->getThrowable())) {
            case MethodNotAllowedHttpException::class:
                $event->setResponse(new Response(null, 405));
                break;
            case BadRequestHttpException::class:
                $event->setResponse(JsonApiResponse::error(400, [$event->getThrowable()->getMessage()]));
                break;
            case NotFoundHttpException::class:
                $event->setResponse(new Response(null, 404));
                break;
            default:
                $event->setResponse(new Response(null, 500));
        }
    }
}
