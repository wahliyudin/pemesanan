<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::oldest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('admin.products.edit', Crypt::encrypt($row->id)) . '"
                        class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)"
                        class="delete btn btn-danger btn-sm" id="' . Crypt::encrypt($row->id) . '">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
        try {
            $product = Product::find($id);

            if (!$product) {
                throw new Exception('Data product tidak ditemukan!', 400);
            }
            $image = Str::replaceFirst(env('APP_URL'). '/'.'storage/', '', $product->photo);
            Storage::delete('public/'.$image);
            $product->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Menghapus data product',
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
