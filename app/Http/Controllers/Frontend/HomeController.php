<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home', [
            'products' => Product::with('category')->latest()->get(),
            'categories' => Category::latest()->get()
        ]);
    }

    public function menu()
    {
        return view('frontend.menu', [
            'products' => Product::with('category')->latest()->get(),
            'categories' => Category::latest()->get()
        ]);
    }

    public function about()
    {
        return view('frontend.about', [
            'products' => Product::with('category')->latest()->get(),
            'categories' => Category::latest()->get()
        ]);
    }

    public function stuff()
    {
        return view('frontend.stuff');
    }

    public function gallery()
    {
        return view('frontend.gallery', [
            'products' => Product::with('category')->latest()->get(),
        ]);
    }

    public function blog()
    {
        return view('frontend.blog');
    }

    public function blogDetail()
    {
        return view('frontend.blog-detail');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function order()
    {
        return view('frontend.pesanan', [
            'orders' => auth()->user()->orders
        ]);
    }

    public function orderDetail($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {

        }
        return view('frontend.detail-pesanan', [
            'order' => Order::with('products', 'user')->find($id)
        ]);
    }
}
