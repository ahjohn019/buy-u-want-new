<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\CartTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class CartController extends BaseController
{
    use CartTrait;

    public function listCart(){
        return $this->getCartContent();
    }

    public function addCart(Product $product){      
        \Cart::session(auth()->user()->id)->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
        ]);

        return $this->listCart();
    }

    public function updateCart(Request $request, Product $product){
        \Cart::session(auth()->user()->id)->update($product->id,[
            'quantity' => [
                'relative' => false,
                'value' => (int)$request->quantity
            ],
        ]);

        return $this->listCart();
    }

    public function removeCart(Product $product){
        \Cart::session(auth()->user()->id)->remove($product->id);
    }
}
