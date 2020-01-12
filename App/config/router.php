<?php

use App\Controllers\OrderController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();
$routes->add('order_create', new Route('/order', [
        '_controller' => [OrderController::class, 'index']]
));
