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

    public function getCartContent(){
        return \Cart::session(auth()->user()->id)->getContent();
    }

    public function getCartTotal(){
        return \Cart::session(auth()->user()->id)->getTotal();
    }

    public function clearAll(){
        \Cart::session(auth()->user()->id)->clear();
    }
}
