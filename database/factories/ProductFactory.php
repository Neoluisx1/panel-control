<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $cost = 10;
        $price1 = $cost * 1.30; //precio normal
        $price2 = $price1-($price1*0.05); //precio por mayor
        $stock = $this->faker->numberBetween(0,500);
        return [
            'Category_id' => Category::all()->random()->id,
            'name' =>$this->faker->word(6),
            'code' => $this->faker->unique()->ean13(),
            'change' => ' ',
            'cost' => $cost,
            'price' => $price1,
            'price2' =>$price2,
            'stock' => $stock,
            'ministock'=>$this->faker->randomElement([5,10,15,20])
        ];
    }
}
