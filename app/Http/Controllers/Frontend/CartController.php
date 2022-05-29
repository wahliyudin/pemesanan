<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CartController extends Controller
{
    public function cartList()
    {
        // return Cart::get(2)->quantity;
        $cartItems = Cart::getContent();
        // return $cartItems;
        return view('frontend.cart-list', compact('cartItems'));
    }

    public function decrement($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
        try {
            if (Cart::get($id)->quantity == 1) {
                Cart::remove($id);
            } else {
                Cart::update(
                    $id,
                    [
                        'quantity' => [
                            'relative' => false,
                            'value' => Cart::get($id)->quantity - 1
                        ],
                    ]
                );
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Menghapus data category',
            ]);
        } catch (\Exception $th) {
            $th->getCode() == 400 ?? $code = 500;
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], $code);
        }
    }

    public function increment($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
        try {
            Cart::update(
                $id,
                [
                    'quantity' => [
                        'relative' => false,
                        'value' => Cart::get($id)->quantity + 1
                    ],
                ]
            );
            return response()->json([
                'status' => 'success',
                'message' => 'Menghapus data category',
            ]);
        } catch (\Exception $th) {
            $th->getCode() == 400 ?? $code = 500;
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], $code);
        }
    }

    public function pesan()
    {
        try {
            $order = Order::create([
                'kode_pesanan' => generateCodeOrder(),
                'tanggal' => now()->format('Y-m-d'),
                'status' => Order::STATUS_FALSE,
                'total' => Cart::getTotal(),
                'user_id' => auth()->user()->getAuthIdentifier(),
                'no_antrian' => generateNoAntrian()
            ]);
            $data = [];
            foreach (Cart::getContent() as $value) {
                $data[$value->id] = ['qty' => $value->quantity, 'total' => $value->quantity * $value->price];
            }
            $order->products()->sync($data);
            Cart::clear();
            if (Order::where('status', Order::STATUS_FALSE)->count() == 1) {
                OrderCreated::dispatch();
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil memesan',
            ]);
        } catch (\Throwable $th) {
            $th->getCode() == 400 ?? $code = 500;
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], $code);
        }
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
