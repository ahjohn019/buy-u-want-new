<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Attachment;
use App\Services\AttachmentServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['name','extension','mime_type','size','product_id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function scopeProductAttachments($query){
        return $query->select('products.sku','attachments.*')
                    ->leftJoin('products', function($query){
                        $query->on('products.id', '=', 'attachments.product_id');
                    });
    }

    //firing events
    public static function boot(){
        parent::boot();

        static::creating(function(){
            $selected = Attachment::where('product_id',request()->id)->first();
            $services = new AttachmentServices;

            if(request()->update && !empty($selected)){
                $services->update(request(), $selected);
                return redirect()->back();
            }
        });
    }
}
