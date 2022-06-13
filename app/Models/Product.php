<?php

namespace App\Models;

use App\Models\User;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','sku','price','image','category_id','discount_id','status'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function variants(){
        return $this->hasMany(Variant::class);
    }

    public function discount(){
        return $this->belongsTo(Discount::class, 'discount_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeGetActiveProduct($query){
        return $query->where('status', 1)->orderBy('created_at', 'DESC');
    }
}
