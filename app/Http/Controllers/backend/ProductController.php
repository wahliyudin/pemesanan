<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\StoreImageTrait;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Image;

class ProductController extends Controller
{
    use StoreImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.product.index', [
            'breadcrumb' => [
                'title' => 'Products',
                'path' => [
                    'Master Data' => route('admin.products.index'),
                    'Products' => 0
                ]
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create', [
            'breadcrumb' => [
                'title' => 'Tambah Product',
                'path' => [
                    'Master Data' => route('admin.products.index'),
                    'Products' => route('admin.products.index'),
                    'Create' => 0
                ]
            ],
            'categories' => Category::latest()->get(['id', 'nama'])
        ]);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(StoreProductRequest $request)
    {
        $request->merge(['harga' => replaceRupiah($request->harga)]);
        $data = $request->all();
        $data['photo'] = $this->storeImage($request->file('photo'));
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
        }

        return view('backend.product.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
