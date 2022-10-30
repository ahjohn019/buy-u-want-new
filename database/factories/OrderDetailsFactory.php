<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $products = Product::find($this->faker->numberBetween(1,3));
        $quantity = $this->faker->numberBetween(1, 10);
        $orderId = $this->faker->numberBetween(1, 3);
        $productId = $this->faker->numberBetween(1, 3);
        
        return [
            'quantity' => $quantity,
            'price' => $products->price * $quantity,
            'order_id' => $orderId,
            'product_id' => $productId,
            'shipment_id' => null
        ];
    }
}
