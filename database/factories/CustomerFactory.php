<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'nit'=> $this->faker->numerify('######'),
            'phone'=> $this->faker->numerify('######'),
            'city'=>$this->faker->city(),
            'mail'=>$this->faker->unique()->safeEmail(),

        ];
    }
}
