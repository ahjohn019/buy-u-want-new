<?php

namespace App\Models;

use App\Models\DiscountDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['name','prefix','discount_details_id'];

    //one coupon belongs to one discount details
    public function discount_details(){
        return $this->belongsTo(DiscountDetails::class);
    }
}
