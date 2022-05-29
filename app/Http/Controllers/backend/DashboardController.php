<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard', [
            'breadcrumb' => [
                'title' => 'Dashboard',
                'path' => [
                    'Dashboard' => 0
                ]
            ],
            'pendapatan' => Payment::sum('tagihan'),
            'pendapatan_hari_ini' => Payment::whereDate('tanggal', now()->format('Y-m-d'))->sum('tagihan'),
            'users' => User::whereRoleIs('customer')->count(),
            'pesanan_hari_ini' => Order::whereDate('tanggal', now()->format('Y-m-d'))->where('status', Order::STATUS_FALSE)->count()
        ]);
    }
}
