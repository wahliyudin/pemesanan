<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function laporan(Request $request)
    {
        $first_date = $request->first_date ? Carbon::make($request->first_date)->format('Y-m-d') : now()->format('Y-m-d');
        $end_date = $request->end_date ? Carbon::make($request->end_date)->format('Y-m-d') : now()->format('Y-m-d');
        $payments = Payment::with('account')->whereBetween('tanggal', [$first_date, $end_date])->get();
        $pdf = Pdf::loadView('exports.laporan', compact('payments', 'first_date', 'end_date'));
        return $pdf->setPaper('A4')->stream();
    }
}
