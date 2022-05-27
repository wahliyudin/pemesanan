<?php

use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::name('api.')->group(function () {
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::post('/', [CategoryController::class, 'index'])->name('index');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [CategoryController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('accounts')->name('accounts.')->group(function () {
        Route::post('/', [AccountController::class, 'index'])->name('index');
        Route::post('store', [AccountController::class, 'store'])->name('store');
        Route::get('{id}/edit', [AccountController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [AccountController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [AccountController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('products')->name('products.')->group(function () {
        Route::post('/', [ProductController::class, 'index'])->name('index');
        Route::delete('{id}/destroy', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::post('/', [OrderController::class, 'index'])->name('index');
    });
});
