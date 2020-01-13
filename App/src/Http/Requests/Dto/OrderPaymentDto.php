<?php


namespace App\Http\Requests\Dto;


use Symfony\Component\Validator\Constraints as Assert;

class OrderPaymentDto
{
    /**
     * @var int
     * @Assert\NotBlank(message="order_id must not be blank")
     * @Assert\Type(type="integer",message="id must be int")
     */
    public $orderId;

    /**
     * @var float
     * @Assert\NotBlank(message="cost must not be blank")
     * @Assert\Type(type="float",message="cost must be float")
     * @Assert\Positive(message="cost must be positive")
     */
    public $cost;
}
