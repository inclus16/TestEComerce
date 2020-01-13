<?php


namespace App\Repositories;


use App\Entities\Order;
use App\Repositories\Abstractions\AbstractRepository;

class OrdersRepository extends AbstractRepository
{

    protected string $entityName = Order::class;

    public function add($entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush($entity);
    }

    public function addRange(array $entities)
    {
        // TODO: Implement addRange() method.
    }

    public function update($entity)
    {
        $this->_em->flush($entity);
    }
}
