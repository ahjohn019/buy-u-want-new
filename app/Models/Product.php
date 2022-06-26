<?php

namespace App\Models;

use App\Models\User;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Discount;
use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','sku','price','image','category_id','user_id','status'];

    //each products belongs to one category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //one products has many variants
    public function variant(){
        return $this->hasMany(Variant::class);
    }
    
    //has one discount on one product
    public function discount(){
        return $this->hasOne(Discount::class);
    }

    //belongs to specific one user create product
    public function user(){
        return $this->belongsTo(User::class);
    }

    //one products has many order details
    public function orderDetails(){
        return $this->hasMany(OrderDetails::class);
    }

    public function scopeGetActiveProduct($query){
        return $query->where('status', 1)->orderBy('created_at', 'DESC');
    }
}
