<?php


namespace App\Http\Requests\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class OrderCreateDto
{
    /**
     * products ids
     * int[]
     * @Assert\NotBlank(message="array 'products' must be at upper level of json body and not be empty")
     * @Assert\Type(type="array",message="array 'products' must be an array")
     */
    public $products;
}
