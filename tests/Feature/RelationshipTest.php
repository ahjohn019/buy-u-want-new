<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RelationshipTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function variable_list(){
        $product = Product::all();
        $variant = Variant::all();
        $coupon = Coupon::all();
        return ['product' => $product,'variant' => $variant, 'coupon' => $coupon];
    }

    /**
     * Test Product Match List
     *
     * @return void
     */
    public function test_products_matched_list(){
        $product = $this->variable_list()['product'];
        $variants = $this->variable_list()['variant'];

        foreach($product as $prod){
            if(is_null($prod->discount) || is_null($prod->category)) continue;

            $this->assertEquals($prod->discount->id, $prod->discount_id);
            $this->assertEquals($prod->category->id, $prod->category_id);
            $this->assertEquals($prod->user->id, $prod->user_id);

            foreach ($prod->pivotDiscount as $key => $value) {
                $discountId = $value::find($value->id)->id;
                $this->assertEquals($discountId, $value->pivot->discount_id);
            }
        }

        foreach ($variants as $variant) {
            if(is_null($variant->product)) continue;
            $this->assertEquals($variant->product->id, $variant->product_id);
        }
    }

    /**
     * Test Coupon Match List
     *
     * @return void
     */
    public function test_coupon_matched_list(){
        $coupons = $this->variable_list()['coupon'];

        foreach ($coupons as $key => $coupon) {
            if(is_null($coupon->discount) || is_null($coupon->product)) continue;

            $this->assertEquals($coupon->discount->id, $coupon->discount_id);
            $this->assertEquals($coupon->product->id, $coupon->product_id);
     
            foreach ($coupon->pivotDiscount as $key => $value) {
                $couponId = $value::find($value->id)->id;
                $this->assertEquals($couponId, $value->pivot->discount_id);
            }
        }
    }


    

}
