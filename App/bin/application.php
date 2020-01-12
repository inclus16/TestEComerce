#!/usr/bin/env php
<?php
// application.php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/services.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new \App\Command\ProductsAbstractSeeder($containerBuilder->get('products')));

$application->run();
