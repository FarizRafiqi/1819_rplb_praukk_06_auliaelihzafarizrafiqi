<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Method ini digunakan untuk menampilkan halaman dashboard admin
     */
    public function index(Request $request)
    {
        $payments = Payment::get();
        $totalPendapatan = $payments->sum('total_bayar');
        $totalPendapatan = 'Rp '. number_format($totalPendapatan, 2, ',', '.');

        $bills = Bill::get();

        return view('pages.admin.index', compact('totalPendapatan', 'bills', 'payments'));
    }
}
