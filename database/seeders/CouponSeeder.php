<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $couponA = [
            'prefix' => 'COUPONA',
            'name' => 'coupon_a',
            'description' => 'its coupon a',
            'usage' => 5,
            'max_usage' => 10,
            'max_usage_per_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'discount_id' => 1,
            'product_id' => 2,
        ];

        $couponDiscountA = [
            'coupon_id' => 1,
            'discount_id' => 1,
            'status' =>'active'
        ];

        DB::table('coupons')->insert([
            $couponA
        ]);

        DB::table('coupons_discounts')->insert(
            $couponDiscountA
        );
    }
}
