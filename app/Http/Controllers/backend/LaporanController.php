<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('backend.laporan.index', [
            'breadcrumb' => [
                'title' => 'Laporan',
                'path' => [
                    'Laporan' => 0
                ]
            ]
        ]);
    }
}
