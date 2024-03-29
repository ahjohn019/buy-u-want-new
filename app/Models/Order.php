<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Payment;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['number','total','grand_total','total_qty','tax','status','payment_id','user_id'];

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    //each order belongs to one user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //one order has many order details
    public function orderDetails(){
        return $this->hasMany(OrderDetails::class);
    }

    public function scopeGetTotalOrderByMonth($query){
        return $query->select(
                    DB::raw('count(*) as total'),
                    DB::raw("DATE_FORMAT(created_at,'%M') as months"),
                    DB::raw("DATE_FORMAT(created_at,'%Y') as years")
                )->groupBy('months','years');
    }
}
