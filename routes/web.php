<?php

use App\Events\CategoryCreated;
use App\Http\Controllers\Backend\AccountController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\TransaksiController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {

    return redirect()->route('login');
});

Route::middleware(['auth', 'role:admin', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('accounts', [AccountController::class, 'index'])->name('accounts.index');

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{id}/update', [ProductController::class, 'update'])->name('products.update');

    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/{id}/bayar', [TransaksiController::class, 'bayar'])->name('transaksi.bayar');
    Route::post('transaksi/{id}/payment', [TransaksiController::class, 'payment'])->name('transaksi.payment');
    Route::get('transaksi/{id}/skip', [TransaksiController::class, 'skip'])->name('transaksi.skip');
});

Route::middleware(['auth', 'role:customer', 'verified'])->name('customer.')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('menu', [HomeController::class, 'menu'])->name('menu');
    Route::get('about', [HomeController::class, 'about'])->name('about');
    Route::get('stuff', [HomeController::class, 'stuff'])->name('stuff');
    Route::get('gallery', [HomeController::class, 'gallery'])->name('gallery');
    Route::get('blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('blog-detail', [HomeController::class, 'blogDetail'])->name('blog-detail');
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
});

Route::get('/dashboard', [CheckController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
