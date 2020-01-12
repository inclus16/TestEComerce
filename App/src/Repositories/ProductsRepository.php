<?php


namespace App\Repositories;


use App\Entities\Product;
use App\Repositories\Abstractions\AbstractRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping;

class ProductsRepository extends AbstractRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new Mapping\ClassMetadata(Product::class));
    }

    public function add($entity)
    {
    }

    public function addRange(iterable $entities)
    {
        foreach ($entities as $entity) {
            $this->_em->persist($entity);
            $this->_em->flush();
        }
    }
}
