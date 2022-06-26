<?php

namespace App\Models;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biography extends Model
{
    use HasFactory;

    protected $fillable = ['gender','birth_date','role','home_number','mobile_number','user_id'];

    //one biography belongs to one user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //many to many relationship (user)
    public function pivotUser(){
        return $this->belongsToMany(User::class, 'user_biography');
    }
}

