<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $discountA = [
            'name' => 'discount a',
            'description' => 'discount a details',
            'value' => 10,
            'method' => 'percentage',
            'type' => 'discount',
            'expiry_at' => '2022-08-02',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $discountB = [
            'name' => 'discount b',
            'description' => 'discount b details',
            'value' => 20,
            'method' => 'percentage',
            'type' => 'discount',
            'expiry_at' => '2022-08-10',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $discountC = [
            'name' => 'discount c',
            'description' => 'discount c details',
            'value' => 30,
            'method' => 'coupon',
            'type' => 'discount',
            'expiry_at' => '2022-08-10',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $productDiscountA = [
            'discount_id' => 1,
            'product_id' => 1,
            'status' =>'active'
        ];

        $productDiscountB = [
            'discount_id' => 2,
            'product_id' => 2,
            'status' =>'active'
        ];

        DB::table('discounts')->insert([
            $discountA, $discountB, $discountC
        ]);

        DB::table('products_discounts')->insert([
            $productDiscountA, $productDiscountB 
        ]);

        
    }
}
