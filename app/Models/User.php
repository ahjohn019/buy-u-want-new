<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

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

    //display admin index information
    public function scopeDisplayAdminInfo($query){
        return $query->select('users.id as id','users.email as email','users.name as fullname','bio.birth_date as birthdate',
                        'users.created_at as created_at','role.name as role')
                    ->leftJoin('biographies as bio', function($query){
                        $query->on('users.id','=','bio.user_id');
                    })
                    ->leftjoin('model_has_roles as model_roles', function($query){
                        $query->on('users.id','=','model_roles.model_id');
                    })
                    ->leftJoin('roles as role', function($query){
                        $query->on('model_roles.role_id','=','role.id');
                    });
    }

    //many to many relationship (biography, address)
    public function pivotBiography(){
        return $this->belongsToMany(Biography::class, 'user_biography');
    }

    public function pivotAddress(){
        return $this->belongsToMany(Address::class, 'user_address');
    }
}
