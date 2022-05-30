<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('backend.account.index', [
            'breadcrumb' => [
                'title' => 'Akun Rekening',
                'path' => [
                    'Master Data' => route('admin.accounts.index'),
                    'Akun Rekening' => 0
                ]
            ]
        ]);
    }
}
