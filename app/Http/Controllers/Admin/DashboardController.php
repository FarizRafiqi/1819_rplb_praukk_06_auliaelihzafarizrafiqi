<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Payment;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

/**
 * Controller ini digunakan untuk menampilkan histori pembayaran terbaru,
 * melihat jumlah pendapatan, total pembayaran, tagihan listrik lunas,
 * dan tagihan listrik belum lunas
 */
class DashboardController extends Controller
{
    /**
     * Method ini digunakan untuk menampilkan halaman dashboard admin
     */
    public function index(Request $request)
    {
        //Hitung total pendapatan
        $payments = Payment::get();
        $totalPendapatan = $payments->sum('total_bayar');
        $totalPendapatan = 'Rp '. number_format($totalPendapatan, 2, ',', '.');

        //ambil pendapatan bulan ini dari stored function yang telah dibuat di database
        // $monthEarnings = DB::select('SELECT getMonthEarnings() AS pendapatan_bulan_ini');
        // if(empty($monthEarnings)){
        //     $monthEarnings = 0;
        // }else{
        //     $monthEarnings = $monthEarnings[0]->pendapatan_bulan_ini;
        //     $monthEarnings = 'Rp '. number_format($monthEarnings, 2, ',', '.');
        // }
        $bills = Bill::get();

        if($request->ajax()){
            $paymentHistories = PaymentHistory::limit(10)->get();
            return DataTables::of($paymentHistories)
                    ->toJson();
        }
        return view('pages.admin.index', compact('totalPendapatan', 'bills', 'payments'));
    }

    /**
     * Method untuk mengatur tampilan dashboard
     */
    public function settings(Request $request)
    {
        return view('pages.admin.settings');
    }
}
