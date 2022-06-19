<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Biography;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\VariantServices;

class BaseController extends Controller
{
    //
    protected $variant;
    protected $product;
    protected $order;
    protected $user;
    protected $biography;
    protected $category;

    public function __construct(
        VariantServices $variantServices, 
        Variant $variant, 
        Product $product,
        Order $order,
        User $user, 
        Biography $biography,
        Category $category
    ){
        $this->middleware(['auth','verified'])->except(['index','show']);
        $this->variantServices = $variantServices;
        $this->variant = $variant;
        $this->product = $product;
        $this->order = $order;
        $this->user = $user;
        $this->biography = $biography;
        $this->category = $category;
    }
}
