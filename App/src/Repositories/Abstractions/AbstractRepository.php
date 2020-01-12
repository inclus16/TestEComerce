<?php


namespace App\Repositories\Abstractions;


use Doctrine\ORM\EntityRepository;

abstract class AbstractRepository extends EntityRepository
{
    public abstract function add($entity);

    public abstract function addRange(array $entities);
}
