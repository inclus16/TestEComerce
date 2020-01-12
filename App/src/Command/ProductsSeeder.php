<?php


namespace App\Command;


use App\Command\Abstractions\Seeder;
use App\Entities\Product;

class ProductsSeeder extends Seeder
{
    private const COUNT_TO_SEED = 20;

    protected static $defaultName = 'seeder:products';


    protected function generateData(): array
    {
        $data = [];
        $minFloatCost = 0.00;
        $maxFloatCost = 60000.99;
        for ($i = 0; $i < self::COUNT_TO_SEED; $i++) {
            $data[] = new Product("Tovar{$i}", ($minFloatCost + lcg_value() * (abs($maxFloatCost - $minFloatCost))));
        }
        return $data;
    }
}
