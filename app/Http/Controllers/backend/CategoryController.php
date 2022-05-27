<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.category.index', [
            'breadcrumb' => [
                'title' => 'Kategori',
                'path' => [
                    'Master Data' => route('admin.categories.index'),
                    'Kategori' => 0
                ]
            ]
        ]);
    }
}
