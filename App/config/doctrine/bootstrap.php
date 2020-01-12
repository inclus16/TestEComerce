<?php

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(__DIR__ . '/../../src/Entities');
$isDevMode = false;

// the connection configuration
$dbParams = require 'connection.php';
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config->setMetadataDriverImpl(new AnnotationDriver(new AnnotationReader(), $paths));
$entityManager = EntityManager::create($dbParams, $config);
