<?php

require_once __DIR__ . '/doctrine/bootstrap.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$containerBuilder->register('products', \App\Repositories\ProductsRepository::class)->addArgument($entityManager);
$containerBuilder->register('order_statuses', \App\Repositories\OrderStatusesRepository::class)->addArgument($entityManager);
$containerBuilder->register('orders', \App\Repositories\OrdersRepository::class)->addArgument($entityManager);
return $containerBuilder;
