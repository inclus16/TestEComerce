<?php


namespace App\Repositories;


use App\Entities\OrderStatus;
use App\Repositories\Abstractions\AbstractRepository;

class OrderStatusesRepository extends AbstractRepository
{
    protected string $entityName = OrderStatus::class;

    public function add($entity)
    {
        // TODO: Implement add() method.
    }

    public function addRange(array $entities)
    {
        // TODO: Implement addRange() method.
    }

    public function update($entity)
    {
        // TODO: Implement update() method.
    }
}
