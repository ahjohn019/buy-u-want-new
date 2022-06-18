<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['type','provider','status','transaction_id','order_id'];

    //one payment has one order details
    public function orderDetails(){
        return $this->hasOne(OrderDetails::class);
    }
}
