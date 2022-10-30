<?php

namespace Database\Seeders;

use App\Models\OrderDetails;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderDetails::factory()->count(5)->create();
        $orderDetails = OrderDetails::select(DB::raw('SUM(price) AS totalPrice'), DB::raw('COUNT(id) AS qty'), 'order_id')->groupBy('order_id')->get();
        foreach($orderDetails as $details) {
            DB::table('orders')->insert([
                'number' => 'ORDER' . Faker::create()->md5,
                'total' => $details->totalPrice,
                'grand_total' => $details->totalPrice,
                'total_qty' => $details->qty,
                'tax' => null,
                'status' => 'completed',
                'user_id' => rand(1,2),
                'payment_id' => Faker::create()->md5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
