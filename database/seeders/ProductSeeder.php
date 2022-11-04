<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('products')->insert([
            [
                'name' => 'Sample Shirt One',
                'description' => 'sampleshirtone',
                'sku' => 'Sample-One',
                'price' => 12.00,
                'image' => null,
                'status' => 1,
                'tags' => '["LaTEst","FeAturED"]',
                'category_id' => 1,
                'user_id' => 1,
                'discount_id' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'name' => 'Sample Shirt Two',
                'description' => 'sampleshirttwo',
                'sku' => 'Sample-Two',
                'price' => 24.00,
                'image' => null,
                'status' => 1,
                'tags' => '["featured","LaTesT"]',
                'category_id' => 1,
                'user_id' => 2,
                'discount_id' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Sample Shirt Three',
                'description' => 'sampleshirtthree',
                'sku' => 'Sample-Three',
                'price' => 40.00,
                'image' => null,
                'status' => 2,
                'tags' => '["OnSaLE"]',
                'category_id' => 1,
                'user_id' => 2,
                'discount_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'name' => 'Sample Shirt Four',
                'description' => 'sampleshirtfour',
                'sku' => 'Sample-Four',
                'price' => 28.00,
                'image' => null,
                'status' => 1,
                'tags' => '["Featured"]',
                'category_id' => 1,
                'user_id' => 2,
                'discount_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Sample Shirt Five',
                'description' => 'sampleshirtfive',
                'sku' => 'Sample-Five',
                'price' => 70.00,
                'image' => null,
                'status' => 1,
                'tags' => '["LAteST","onSaLE"]',
                'category_id' => 1,
                'user_id' => 2,
                'discount_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);

        DB::table('variants')->insert([
            [
                'name' => 'red',
                'type' => 'colour',
                'status' => 1,
                'product_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'white',
                'type' => 'colour',
                'status' => 1,
                'product_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'rectangle',
                'type' => 'shape',
                'status' => 1,
                'product_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
