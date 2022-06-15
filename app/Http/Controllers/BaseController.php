<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    //
    public function __construct(){
        $this->middleware(['auth','verified'])->except(['index','show']);
    }
}
