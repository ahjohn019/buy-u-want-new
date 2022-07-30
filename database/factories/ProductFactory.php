<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
            'description' => $this->faker->text(),
            'sku' => strtoupper($this->faker->word(10)),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'image' => null,
            'status' => 1,
            'category_id' => 1,
            'user_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'discount_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
