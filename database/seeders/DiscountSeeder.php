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
            'status' => 1,
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
            'status' => 1,
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
            'status' => 2,
            'expiry_at' => '2022-08-10',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        DB::table('discounts')->insert([
            $discountA, $discountB, $discountC
        ]);

        
    }
}
