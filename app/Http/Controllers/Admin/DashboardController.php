<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Payment;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Charts\YearlyEarnings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

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
        $payments = Payment::where('status', 'success')->get();
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
            $paymentHistories = PaymentHistory::with(['payment', 'payment.paymentMethod'])
                                                ->when(auth()->user()->isBank(), function($query) {
                                                    return 
                                                    $query->whereHas('payment.paymentMethod', function(Builder $query) {
                                                        $bankName = explode(" ", auth()->user()->username);
                                                        $query->where('nama', 'like' ,'%'.$bankName[1].'%');
                                                    });
                                                })->get();
            return DataTables::of($paymentHistories)
                               ->toJson();
        }

        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $data = [];
        foreach ($months as $index => $month) {
            $data[$index] = Payment::where('status', 'success')
                                   ->whereYear('created_at', now()->year)
                                   ->whereMonth('created_at', $index)
                                   ->get()
                                   ->sum('total_bayar');
        }

        $chart = new YearlyEarnings;
        $chart->title('Pendapatan Tahun '.now()->year);
        $chart->labels($months);
        $chart->dataset('Pendapatan Tahun '. now()->year, 'line', $data);
        $chart->options([
                            'maintainAspectRatio' => false,
                            'borderColor'=>'rgb(75, 192, 192)',
                            'scales' => ['y' => 
                                [
                                    'min' => 0,
                                ]
                            ]
                        ], true);
        return view('pages.admin.index', compact('totalPendapatan', 'bills', 'payments', 'chart'));
    }

    /**
     * Method untuk mengatur tampilan dashboard
     */
    public function settings(Request $request)
    {
        return view('pages.admin.settings');
    }
}
