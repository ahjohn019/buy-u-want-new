<?php

namespace App\Models;

use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = ['name','charge'];

    //one shipment has one order details
    public function orderDetails(){
        return $this->hasOne(OrderDetails::class);
    }
}
