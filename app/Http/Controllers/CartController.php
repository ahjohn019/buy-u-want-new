<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\CartTrait;
use Illuminate\Http\Request;
use App\Traits\DiscountTrait;
use App\Http\Controllers\BaseController;

class CartController extends BaseController
{
    use CartTrait, DiscountTrait;

    /**
     * List All Items In The cart
     *
     * @return void
     */
    public function listCart(){
        return $this->getCartContent();
    }

    /**
     * Add The Product Into The Cart
     *
     * @param Product $product
     * @return void
     */
    public function addCart(Product $product){   
        \Cart::session(auth()->user()->id)->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $this->discountProcess($product),
            'quantity' => 1,
        ]);

        return $this->listCart();
    }

    /**
     * Update The Product In The Cart
     *
     * @param Request $request
     * @param Product $product
     * @return void
     */
    public function updateCart(Request $request, Product $product){
        \Cart::session(auth()->user()->id)->update($product->id,[
            'quantity' => [
                'relative' => false,
                'value' => (int)$request->quantity
            ],
        ]);

        return $this->listCart();
    }

    /**
     * Remove Product From The Cart
     *
     * @param Product $product
     * @return void
     */
    public function removeCart(Product $product){
        \Cart::session(auth()->user()->id)->remove($product->id);
    }

    /**
     * Clear All The Product In The Cart
     *
     * @return void
     */
    public function clearCart(){
        return $this->clearAll();
    }
}
