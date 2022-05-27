<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Account;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TransaksiController extends Controller
{
    public function index()
    {
        // return Order::with(['user', 'products'])->where('status',
        // Order::STATUS_FALSE)->orderBy('no_antrian', 'ASC')->first();
        return view('backend.transaksi.index', [
            'breadcrumb' => [
                'title' => 'Transaksi',
                'path' => [
                    'Transaksi' => 0
                ]
            ],
            'order' => Order::with(['user', 'products'])->where(
                'status',
                Order::STATUS_FALSE
            )->orderBy('no_antrian', 'ASC')->first()
        ]);
    }

    public function bayar($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
        }

        return view('backend.transaksi.bayar', [
            'breadcrumb' => [
                'title' => 'Bayar',
                'path' => [
                    'Transaksi' => route('admin.transaksi.index'),
                    'Bayar' => 0
                ]
            ],
            'accounts' => Account::latest()->get(),
            'order' => Order::with('user:id,name')->find($id),
            'payment_number' => generatePaymentNumber(new Payment(), 'NP', 'no_pembayaran')
        ]);
    }

    public function payment(StorePaymentRequest $request, $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
        }
        $request->merge(['tagihan' => replaceRupiah($request->tagihan)]);
        $request->merge(['total' => replaceRupiah($request->total)]);
        $request->merge(['kembalian' => replaceRupiah($request->kembalian)]);
        $request->merge(['tanggal' => Carbon::make($request->tanggal)->format('Y-m-d')]);
        $request->merge(['order_id' => $id]);
        Order::find($id)->update(['status' => Order::STATUS_TRUE]);
        Payment::create($request->all());

        return redirect()->route('admin.transaksi.index')->with('success', 'Pembayaran berhasil');
    }

    public function skip($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
        }
        Order::find($id)->update(['status' => Order::STATUS_CANCEL]);
        return redirect()->route('admin.transaksi.index');
    }
}
