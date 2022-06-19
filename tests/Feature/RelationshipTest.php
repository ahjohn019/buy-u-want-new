<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RelationshipTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_products_matched_with_variants(){
        //
        $product = Product::find(2);

        foreach($product->variant as $variant){
            $this->assertEquals($variant->product_id, $product->id);
        }
    }
}
