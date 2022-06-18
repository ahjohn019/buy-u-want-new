<?php

namespace App\Models;

use App\Models\Product;
use App\Models\DiscountDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','status','product_id'];

    //belongs to only one product have discount
    public function product(){
        return $this->belongsTo(Product::class);
    }

    //one discount has one discount details
    public function discount_details(){
        return $this->hasOne(DiscountDetails::class);
    }
}
