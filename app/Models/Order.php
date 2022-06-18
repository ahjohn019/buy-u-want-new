<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['number','total','grand_total','tax','status','user_id'];

    //each order belongs to one user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //one order has many order details
    public function orderDetails(){
        return $this->hasMany(OrderDetails::class);
    }
}
