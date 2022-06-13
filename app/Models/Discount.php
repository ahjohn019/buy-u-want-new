<?php

namespace App\Models;

use App\Models\Product;
use App\Models\DiscountDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','status','discount_details_id','product_id'];

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function discount_details(){
        return $this->belongsTo(DiscountDetails::class);
    }
}
