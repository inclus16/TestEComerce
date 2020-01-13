<?php


namespace App\Repositories\Abstractions;


use App\Entities\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

abstract class AbstractRepository extends EntityRepository
{
    protected string $entityName;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata($this->entityName));
    }
    public abstract function add($entity);

    public abstract function addRange(array $entities);
}
