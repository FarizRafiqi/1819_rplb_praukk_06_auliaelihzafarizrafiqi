<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::get();
        $totalPendapatan = $payments->sum('total_bayar');
        $totalPendapatan = 'Rp '. number_format($totalPendapatan, 2, ',', '.');

        $bills = Bill::get();

        return view('pages.admin.index', compact('totalPendapatan', 'bills', 'payments'));
    }

    public function profile()
    {
        return view('pages.admin.profile');
    }
}
