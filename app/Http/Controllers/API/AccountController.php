<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Account::oldest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm"
        id="' . Crypt::encrypt($row->id) . '">Ubah</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm"
        id="' . Crypt::encrypt($row->id) . '">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        try {
            Account::create([
                'nama' => $request->nama,
                'code' => $request->code
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Menambahkan data akun',
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
            $account = Account::find($id);
            if (!$account) {
                throw new Exception('Data akun tidak ditemukan!', 400);
            }
            $data = [
                'id' => Crypt::encrypt($account->id),
                'nama' => $account->nama,
                'code' => $account->code
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
            $account = Account::find($id);
            if (!$account) {
                throw new Exception('Data akun tidak ditemukan!', 400);
            }
            $account->update([
                'nama' => $request->nama_update,
                'code' => $request->code_update
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Memperbarui data akun',
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
            $account = Account::find($id);

            if (!$account) {
                throw new Exception('Data akun tidak ditemukan!', 400);
            }

            $account->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Menghapus data akun',
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
