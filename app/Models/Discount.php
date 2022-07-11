<?php

namespace App\Models;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\DiscountDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','value','method','type','expiry_at'];

    //one discount has many product include
    public function product(){
        return $this->hasMany(Product::class);
    }

    //one discount has one coupon details
    public function coupon(){
        return $this->hasOne(Coupon::class);
    }

    public function pivotCoupon(){
        return $this->belongsToMany(Coupon::class, 'coupons_discounts');
    }

    public function pivotProduct(){
        return $this->belongsToMany(Product::class, 'products_discounts');
    }
}
