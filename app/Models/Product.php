<?php

namespace App\Models;

use App\Models\User;
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

    protected $fillable = ['name','description','sku','price','image','tags','category_id','user_id','discount_id','status'];

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


    public function discount(){
        return $this->belongsTo(Discount::class);
    }

    //get active products
    public function scopeGetActiveProduct($query){
        return $query->where('status', 1)->orderBy('created_at', 'DESC');
    }

    //filter important data for admin index
    public function scopeGetAdminIndex($query){
        return $query->leftJoin('categories as category','category.id','=','products.category_id')
                     ->leftJoin('status','status.id','=','products.status')
                     ->select(
                            'products.name',
                            'products.description',
                            'category.name as category',
                            'products.sku',
                            'products.price',
                            'products.image',
                            'status.name as status',
                            'products.created_at',
                     );
                     
    }

    //get filter product prices
    public function scopefilterPrice($query, $priceRange){
        return $query->whereBetween('price',[0, (int)$priceRange]);
    }

    //search the product information
    public function scopeSearchProductByAdmin($query, $search, $columns){
        return $query->where(function($query) use($search, $columns){ 
                        foreach($columns as $column){
                            $column = "products." . $column;
                            if($column == "products.category") $column = "category.name";
                            if($column == "products.status") $column = "status.name";
                            $query->orWhere($column, 'like', '%'. $search.'%');
                        }
                    });
  
    }
}
