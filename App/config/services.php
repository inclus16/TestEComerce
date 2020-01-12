<?php

require_once __DIR__ . '/doctrine/bootstrap.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$containerBuilder->register('products', \App\Repositories\ProductsRepository::class)->addArgument($entityManager);
return $containerBuilder;
