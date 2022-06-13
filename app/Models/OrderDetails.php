<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = ['quantity','price','order_id','product_id','shipment_id'];

    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function shipment(){
        return $this->belongsTo(Shipment::class,'shipment_id','id');
    }
}
