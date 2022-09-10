<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['name','extension','mime_type','size','product_id'];

    public function products(){
        return $this->belongsTo(Product::class);
    }
}
