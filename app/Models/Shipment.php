<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = ['name','charge','location_id'];

    public function location(){
        return $this->belongsTo(Location::class,'location_id','id');
    }
}
