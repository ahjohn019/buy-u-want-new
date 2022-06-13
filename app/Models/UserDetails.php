<?php

namespace App\Models;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable = ['gender','birth_date','role','home_number','mobile_number','user_id','user_address_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }
}

