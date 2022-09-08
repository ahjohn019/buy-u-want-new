<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StripeUsers extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','stripe_customer_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
