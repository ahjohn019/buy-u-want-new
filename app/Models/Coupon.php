<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['prefix','name','description','usage','max_usage','max_usage_per_user','discount_id','product_id'];

    public function discount(){
        return $this->belongsTo(Discount::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function pivotDiscount(){
        return $this->belongsToMany(Discount::class, 'coupons_discounts');
    }
}
