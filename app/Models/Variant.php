<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['name','type','product_id','status'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function scopeGetActiveVariant($query){
        return $query->where('status',1)->orderBy('created_at','DESC');
    }
}
