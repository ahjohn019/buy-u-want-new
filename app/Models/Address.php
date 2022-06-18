<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['address_line_one','address_line_two','postcode','user_id','city','state','country'];

    //belongs to only one user have address
    public function user(){
        return $this->belongsTo(User::class);
    }
}
