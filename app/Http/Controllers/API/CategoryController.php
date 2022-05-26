<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::oldest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)"
                        class="edit btn btn-success btn-sm" id="'.Crypt::encrypt($row->id).'">Edit</a> <a
                            href="javascript:void(0)"
                        class="delete btn btn-danger btn-sm" id="'.Crypt::encrypt($row->id).'">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        try {
            Category::create([
                'nama' => $request->nama
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Menambahkan data category',
            ]);
        } catch (\Exception $th) {
            $th->getCode() == 400 ?? $code = 500;
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], $code);
        }
    }

    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $category = Category::find($id);
            if (!$category) {
                throw new Exception('Data category tidak ditemukan!', 400);
            }
            $data = [
                'id' => Crypt::encrypt($category->id),
                'nama' => $category->nama
            ];
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ]);
        } catch (\Exception $th) {
            $th->getCode() == 400 ?? $code = 500;
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], $code);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $id = Crypt::decrypt($id);
            $category = Category::find($id);
            if (!$category) {
                throw new Exception('Data category tidak ditemukan!', 400);
            }
            $category->update([
                'nama' => $request->nama_update,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Memperbarui data category',
            ]);
        } catch (\Exception $th) {
            $th->getCode() == 400 ?? $code = 500;
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], $code);
        }
    }

    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $category = Category::find($id);

            if (!$category) {
                throw new Exception('Data category tidak ditemukan!', 400);
            }

            $category->delete();

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
