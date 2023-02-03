<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Biography;
use Illuminate\Http\Request;
use App\Services\VariantServices;

class BaseController extends Controller
{
    //
    protected $variant;
    protected $order;
    protected $biography;
    protected $category;
    protected $discount;
    protected $coupon;

    public function __construct(
        VariantServices $variantServices, 
        Variant $variant, 
        Order $order,
        Biography $biography,
        Category $category,
        Address $address,
        Discount $discount,
        Coupon $coupon
    ){
        $this->middleware(['auth','verified'])->except(['index','show']);
        $this->variantServices = $variantServices;
        $this->variant = $variant;
        $this->order = $order;
        $this->biography = $biography;
        $this->category = $category;
        $this->address = $address;
        $this->discount = $discount;
        $this->coupon = $coupon;
    }

    public function index(){
        $authUser = auth()->user();
        $roles = null;

        if($authUser){
            $roles = $authUser->roles->first()->name; 
        }

        return Inertia::render('Front/Master/Index',['auth'=> $authUser, 'roles'=> $roles ]);
    }

    public function dashboard(){
        return Inertia::render('Dashboard');
    }
}
