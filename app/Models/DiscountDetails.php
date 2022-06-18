<?php

namespace App\Models;

use App\Models\Coupon;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountDetails extends Model
{
    use HasFactory;

    protected $fillable = ['type','category','value','total_usage','discount_id'];

    //one discount details belongs to one discount
    public function discount(){
        return $this->belongsTo(Discount::class);
    }

    //one coupon has one discount details
    public function coupon(){
        return $this->hasOne(Coupon::class);
    }
}
