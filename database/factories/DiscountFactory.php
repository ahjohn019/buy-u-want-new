<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(10),
            'description' => $this->faker->text(100),
            'value' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 100),
            'method' => $this->faker->randomElement(['discount','coupon']),
            'type' => $this->faker->randomElement(['fixed','percentage']),
            'expiry_at' => $this->faker->dateTimeBetween('+1 days', '+30 days')->format('Y-m-d'),
        ];
    }
}
