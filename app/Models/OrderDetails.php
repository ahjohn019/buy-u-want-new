<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = ['quantity','price','order_id','product_id','shipment_id'];

    //each order belongs to one order
    public function order(){
        return $this->belongsTo(Order::class);
    }

    //each product contain one order details
    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    //one order details belongs to one shipment 
    public function shipment(){
        return $this->belongsTo(Shipment::class);
    }

    //display overview of order on admin pages
    public function scopeOrderOverview($query){
        $query->select('orders.number','orders.created_at','users.email','orders.status')
            ->addSelect(DB::raw('SUM(order_details.price) AS total'), DB::raw('COUNT(order_details.id) AS items'))
            ->leftJoin('orders',function($join){
                $join->on('orders.id', '=','order_details.order_id');
            })
            ->leftJoin('users', function($join){
                $join->on('orders.user_id','=','users.id');
            })
            ->groupBy('order_details.order_id')
            ->orderBy('orders.created_at','DESC');
    }
}
