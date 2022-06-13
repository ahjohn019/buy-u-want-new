<?php

namespace App\Models;

use App\Models\Coupon;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountDetails extends Model
{
    use HasFactory;

    protected $fillable = ['type','category','value','total_usage','discount_id','coupon_id'];

    public function discount(){
        return $this->belongsTo(Discount::class, 'discount_id','id');
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class, 'coupon_id','id');
    }
}
