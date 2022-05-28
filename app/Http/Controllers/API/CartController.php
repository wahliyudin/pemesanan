<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CartController extends Controller
{
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
        dd(Cart::get(2));
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
}
