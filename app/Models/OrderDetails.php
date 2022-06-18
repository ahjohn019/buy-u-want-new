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

    protected $fillable = ['quantity','price','order_id','product_id','payment_id','shipment_id'];

    //each order belongs to one order
    public function order(){
        return $this->belongsTo(Order::class);
    }

    //each product contain one order details
    public function product(){
        return $this->belongsTo(Product::class);
    }

    //one order details belongs to one payment id
    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    //one order details belongs to one shipment 
    public function shipment(){
        return $this->belongsTo(Shipment::class);
    }
}
