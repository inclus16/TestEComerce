<?php


namespace App\Repositories;


use App\Repositories\Abstractions\AbstractRepository;

class ProductsRepository extends AbstractRepository
{


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
