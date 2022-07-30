<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'prefix' => strtoupper($this->faker->text(8)),
            'name' => $this->faker->text(8),
            'description' => $this->faker->text(100),
            'usage' => $this->faker->numberBetween($min = 1, $max = 10),
            'max_usage' => $this->faker->numberBetween($min = 10, $max = 100),
            'max_usage_per_user' => 1,
            'discount_id' => 1,
            'product_id' => 1,
        ];
    }
}
