<?php


namespace App\Repositories;


use App\Entities\Product;
use App\Repositories\Abstractions\AbstractRepository;
use Doctrine\Common\Collections\ArrayCollection;

class ProductsRepository extends AbstractRepository
{

    protected string $entityName = Product::class;

    public function findRange(array $ids): ArrayCollection
    {
        if (empty($ids)) {
            throw new \InvalidArgumentException('array ids must be not empty');
        }
        $collection = new ArrayCollection();
        foreach ($ids as $id) {
            if (!is_int($id)) {
                throw new \InvalidArgumentException('array ids must contains only integers, got: ' . gettype($id));
            }
            $collection->add($this->find($id));
        }
        return $collection;
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
