<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $number = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 100);
        $date = $this->faker->dateTimeBetween('-180 days', '+180 days');

        return [
            'number' => 'ORDER' . $this->faker->md5(),
            'total' => $number,
            'grand_total' => $number,
            'tax' => null,
            'status' => 'completed',
            'user_id' => $this->faker->randomDigit(),
            'payment_id' => $this->faker->md5(),
            'created_at' => $date,
            'updated_at' => $date
        ];
    }
}
