<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Status;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Attachment;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','sku','price','tags','category_id','user_id','discount_id','status'];

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    //each products belongs to one category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //one products has many variants
    public function variant(){
        return $this->hasMany(Variant::class);
    }

    //belongs to specific one user create product
    public function user(){
        return $this->belongsTo(User::class);
    }

    //one products has many order details
    public function orderDetails(){
        return $this->hasMany(OrderDetails::class);
    }

    //one products has many attachments
    public function attachments(){
        return $this->hasMany(Attachment::class);
    }

    //one products has one status
    public function status(){
        return $this->hasOne(Status::class, 'id', 'status');
    }

    public function discount(){
        return $this->belongsTo(Discount::class);
    }

    //get active products
    public function scopeGetActiveProduct($query){
        return $query->where('status', 1)->orderBy('created_at', 'DESC');
    }

    //get filter product prices
    public function scopefilterPrice($query, $priceRange){
        return $query->whereBetween('price',[0, (int)$priceRange]);
    }

    //search product information
    public function scopeSearchProduct($query, $search){
        return $query->orWhere(function($query) use($search){
                    $columns = ['name','description','sku', 'price', 'tags'];
                    foreach($columns as $column){
                        $query->orWhere($column, 'like', '%'. $search .'%');
                    }
                })
                ->orWhereHas('category', function($query) use($search){ 
                    $query->where('name', 'like', '%'. $search .'%');
                })
                ->orWhereHas('status', function($query) use($search){ 
                    $query->where('name', 'like', '%'. $search .'%');
                });
    }
}
