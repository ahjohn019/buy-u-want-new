<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','status','user_id'];

    //one category belongs to one user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //one category has many products
    public function product(){
        return $this->hasMany(Product::class);
    }

    public function scopeGetActiveCategory($query){
        return $query->where('status', 1)->orderBy('name', 'ASC');
    }
}
