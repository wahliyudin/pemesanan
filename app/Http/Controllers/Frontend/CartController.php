<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = Cart::getContent();
        // return $cartItems;
        return view('frontend.cart-list', compact('cartItems'));
    }


    public function addToCart($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {

        }
        $product = Product::find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->nama,
            'price' => $product->harga,
            'quantity' => 1,
            'attributes' => array(
                'image' => $product->photo,
            )
        ]);

        return back()->with('success', 'Product is Added to Cart Successfully !');
    }

    public function updateCart(Request $request)
    {
        Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {

        }
        Cart::remove($id);
        return back()->with('success', 'Item Cart Remove Successfully !');
    }

    public function clearAllCart()
    {
        Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
}
