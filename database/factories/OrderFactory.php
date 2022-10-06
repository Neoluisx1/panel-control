<?php

namespace Database\Factories;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $total = $this->faker->randomFloat(2,0,5000);
        $discountRand=$this->faker->randomElement(0,2,8,10);
        $dto = intval(($total * $discountRand)/100);
        return [
            'total'=> $total,
            'shipping' => 0,
            'items' => $this->faker->numberBetween(1,10),
            'discount' => $dto,
            'type' => $this->faker->randomElement(['Web','Local']),
            'status'=> $this->faker->randomElement(['Delivered','Pending']),
            'user_id'=>User::all()->random()->id,
            'customer_id'=>Customer::all()->random()->id,

        ];
    }
}
