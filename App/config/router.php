<?php

use App\Controllers\OrderController;
use App\Controllers\OrderPaymentController;
use App\Controllers\ProductController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('order_list', new Route('/order', [
    '_controller' => [OrderController::class, 'list']],[],[],null,[],['GET']
));
$routes->add('order_create', new Route('/order', [
        '_controller' => [OrderController::class, 'create']],[],[],null,[],['POST']
));
$routes->add('order_pay', new Route('/order/pay', [
    '_controller' => [OrderPaymentController::class, 'pay']],[],[],null,[],['POST']
));
$routes->add('product_list', new Route('/product', [
    '_controller' => [ProductController::class, 'list']],[],[],null,[],['GET']
));
