<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
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
        return Inertia::render('Front/Cart/Index', [
            "cart"=> $this->getList()['cart'],
            "unitTotal"=> $this->getList()['unitTotal'],
            "total" => $this->getCartTotal()
        ]);
    }

    /**
     * Add The Product Into The Cart
     *
     * @param Product $product
     * @return void
     */
    public function addCart(Product $product, Request $request){
        $this->getAuthSession()->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $this->discountProcess($product),
            'quantity' => $request->cartQty,
            'attributes' => [
            ]
        ]);

        return redirect()->route('cart.index')->with('addCartSuccessMessage',sessionMessage()['addCartSuccessMessage']);
    }

    /**
     * Update The Product In The Cart
     *
     * @param Request $request
     * @param Product $product
     * @return void
     */
    public function updateCart(Request $request, $product){
        $this->getAuthSession()->update($product,[
            'quantity' => [
                'relative' => false,
                'value' => (int)$request->quantity
            ],
        ]);

        return back()->withInput();
    }

    /**
     * Remove Product From The Cart
     *
     * @param Product $product
     * @return void
     */
    public function removeCart($product){
        $this->getAuthSession()->remove($product);
        return back()->withInput();
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
