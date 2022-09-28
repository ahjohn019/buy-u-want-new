<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ChartServices;

class ChartController extends Controller
{
    //
    public function orders(){
        //
        $data = Order::getTotalOrderByMonth()->get();
        $ordersData = ChartServices::orderServices($data);

        return response()->json(["ordersData" => $ordersData['result'], "monthList" => array_keys($ordersData['monthList']) ]);
    }
}
