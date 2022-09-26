<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    //
    public function orders(){
        //
        $data = Order::getTotalOrderByMonth()->get();

        $months = $data->pluck('months')->toArray();
        $indexedArray = ["red", "blue", "green", "white"];

        foreach($data as $d){
            $result[$d['years']]['months'][$d->months] = $d->total;
            $result[$d['years']]['colors'] = $indexedArray[array_rand($indexedArray)];
        }
        
        return response()->json(["data"=>$data, "months"=>$months ,"result" => $result ]);
    }
}
