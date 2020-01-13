<?php

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Sys\ArgumentResolver;
use Sys\ControllerResolver;
use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/** @var ClassLoader $loader */
$loader = require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');
require __DIR__ . '/../config/router.php';
AnnotationRegistry::registerLoader([$loader, 'loadClass']);
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Methods: *");
$containerBuilder = require __DIR__ . './../config/services.php';
$request = Request::createFromGlobals();

$matcher = new UrlMatcher($routes, new RequestContext());
$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));
if ($_ENV['APP_DEBUG'] == "true") {
    Debug::enable();
} else {
    $dispatcher->addListener('kernel.exception', function (\Symfony\Component\HttpKernel\Event\ExceptionEvent $event) {
       \Sys\ExceptionHandler::onError($event);
    });
}

$controllerResolver = new ControllerResolver($containerBuilder);
$argumentResolver = new ArgumentResolver($containerBuilder);

$kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);
$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
