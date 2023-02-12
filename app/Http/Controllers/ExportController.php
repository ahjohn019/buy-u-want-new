<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportController extends Controller
{
    //
    public function exports(Request $request){
        foreach($request->all() as $product){
            $result[] = [
                'name' => $product['name'],
                'description' => $product['description'],
                'category' => $product['category']['name'],
                'sku' => $product['sku'],
                'price' => $product['price'],
                'status' => $product['status']['name'],
                'tags' => $product['tags'],
                'created_at' => $product['created_at'],
                'updated_at' => $product['updated_at'],
            ];
        }
        $list = collect($result);
        return (new FastExcel($list))->download('products_'. Carbon::now()->format('Y-m-d') .'.xlsx');
    }
}
