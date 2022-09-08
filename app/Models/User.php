<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Biography;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_details_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //one user has one biography
    public function biography(){
        return $this->hasOne(Biography::class);
    }

    //one category has created by one user
    public function category(){
        return $this->hasOne(Category::class);
    }

    //one user has many addresses
    public function address() {
        return $this->hasMany(Address::class);
    }

    //product has only one created by user
    public function product(){
        return $this->hasOne(Product::class);
    }

    //one user has many orders
    public function order(){
        return $this->hasMany(Order::class);
    }

    public function scopeFindAuthUser($query){
        return $query->where('id',auth()->user()->id);
    }

    //one to one stripe users
    public function stripeUsers(){
        return $this->hasOne(StripeUsers::class);
    }

    //many to many relationship (biography, address)
    public function pivotBiography(){
        return $this->belongsToMany(Biography::class, 'user_biography');
    }

    public function pivotAddress(){
        return $this->belongsToMany(Address::class, 'user_address');
    }
}
