<?php


namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\OrdersRepository")
 * @ORM\Table(name="orders")
 */
class Order
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @var OrderStatus
     * @ORM\OneToOne(targetEntity="OrderStatus")
     * @ORM\JoinColumn(name="order_id",referencedColumnName="id")
     */
    private OrderStatus $status;

    /**
     * @var Product[]
     * @ORM\ManyToMany(targetEntity="Product")
     * @ORM\JoinTable(name="order_products",
     *      joinColumns={@ORM\JoinColumn(name="order_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     *      )
     */
    private iterable $products;

    public function __construct(array $products = null)
    {
        $this->products = new ArrayCollection($products);
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProducts(): ArrayCollection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        $this->products->add($product);
        return $this;
    }

    public function setProducts(array $products): self
    {
        $this->products = new ArrayCollection($products);
        return $this;
    }

    public function setStatus(OrderStatus $status): self
    {
        $this->status = $status;
        return $this;
    }

}
