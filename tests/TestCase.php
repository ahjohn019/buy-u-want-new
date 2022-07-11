<?php

namespace Tests;

use Faker\Factory;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function fakerData(){
        return Factory::create();
    }

    public function route_preparation(){
        return [
            'categories' => Category::factory()->create()->toArray(),
            'discounts'=> Discount::factory()->create()->toArray(),
            'variants' => Variant::factory()->create()->toArray(),
            'products' => Product::factory()->create()->toArray(),
        ];
    }
}
